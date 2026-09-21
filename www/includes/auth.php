<?php
// includes/auth.php - Session management, authentication & role/package permissions

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Returns currently logged-in user array or null
 */
function get_current_user_data(): ?array {
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    try {
        $db = get_db();
        $stmt = $db->prepare("SELECT id, email, name, phone, package_level, status FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();
        if ($user && $user['status'] === 'ACTIVE') {
            return $user;
        }
    } catch (Exception $e) {
        error_log("Auth fetch error: " . $e->getMessage());
    }

    return null;
}

/**
 * Attempts to log in user with email & password
 */
function login_user(string $email, string $password): array {
    $email = trim(mb_strtolower($email));
    if (empty($email) || empty($password)) {
        return ['success' => false, 'error' => 'Будь ласка, введіть email та пароль'];
    }

    try {
        $db = get_db();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            return ['success' => false, 'error' => 'Користувача з таким email не знайдено. Перевірте пошту або оформіть покупку курсу.'];
        }

        if ($user['status'] !== 'ACTIVE') {
            return ['success' => false, 'error' => 'Ваш обліковий запис тимчасово заблоковано. Зверніться в підтримку.'];
        }

        if (!password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'error' => 'Невірний пароль. Будь ласка, перевірте лист із доступами.'];
        }

        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_package'] = (int)$user['package_level'];
        $_SESSION['user_name'] = $user['name'];

        // Update last login
        $db->prepare("UPDATE users SET last_login_at = CURRENT_TIMESTAMP WHERE id = :id")->execute([':id' => $user['id']]);

        return ['success' => true, 'user' => $user];
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Помилка авторизації. Спробуйте пізніше.'];
    }
}

/**
 * Destroys session
 */
function logout_user(): void {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

/**
 * Enforces authentication & package level access.
 * If user does not have enough level, renders locked upgrade screen and halts execution.
 */
function require_package(int $required_level): array {
    $user = get_current_user_data();
    $packages = get_packages_config();
    $target_package = $packages[$required_level] ?? null;

    // Allow local preview testing from 127.0.0.1
    if (isset($_GET['preview_pkg']) && in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'])) {
        $lvl = (int)$_GET['preview_pkg'];
        if ($lvl >= $required_level) {
            return [
                'id' => 999,
                'email' => 'kateryna.hudym@example.com',
                'name' => 'Гудим Катерина',
                'package_level' => $lvl,
                'status' => 'ACTIVE'
            ];
        }
    }

    if (!$user) {
        $current_url = $_SERVER['REQUEST_URI'] ?? 'index.php';
        header("Location: login.php?redirect=" . urlencode($current_url) . "&notice=auth_required");
        exit;
    }

    $user_level = (int)$user['package_level'];

    // If user's package is lower than required -> show beautiful upgrade barrier
    if ($user_level < $required_level) {
        $user_package_name = $packages[$user_level]['name'] ?? 'Базовий';
        $req_package_name = $target_package['name'] ?? ('Пакет ' . $required_level);
        $req_price = $target_package['price'] ?? 0;
        ?>
        <!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Доступ обмежено | <?php echo htmlspecialchars($req_package_name); ?></title>
            <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="css/main.css">
            <link rel="stylesheet" href="css/paket-1.css">
            <style>
                body { background: #F3F1E7; font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
                .locked-card { background: #FFFFFF; max-width: 580px; width: 100%; border-radius: 28px; padding: 48px 40px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.08); border: 2px solid #DDD9E3; position: relative; }
                .locked-icon-wrap { width: 80px; height: 80px; background: rgba(25, 27, 223, 0.08); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px; color: #191BDF; }
                .locked-icon-wrap svg { width: 40px; height: 40px; }
                .locked-title { font-family: 'Oswald', sans-serif; font-size: 32px; text-transform: uppercase; color: #191BDF; margin: 0 0 12px; letter-spacing: 0.5px; }
                .locked-desc { font-size: 15px; color: #5B5866; line-height: 1.6; margin-bottom: 24px; }
                .user-badge-bar { background: #F6F4FB; border-radius: 12px; padding: 12px 18px; font-size: 14px; color: #2B2A2E; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
                .btn-upgrade { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #191BDF; color: #FFFFFF !important; padding: 16px 36px; border-radius: 50px; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none; box-shadow: 0 10px 25px rgba(25, 27, 223, 0.25); transition: transform 0.2s; }
                .btn-upgrade:hover { transform: translateY(-2px); }
                .back-link { display: block; margin-top: 24px; font-size: 14px; color: #8C8894; text-decoration: none; }
                .back-link:hover { color: #191BDF; text-decoration: underline; }
            </style>
        </head>
        <body>
            <div class="locked-card">
                <div class="locked-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h1 class="locked-title">Матеріал закрито</h1>
                <p class="locked-desc">
                    Цей розділ доступний лише для учасників тарифу <strong>«<?php echo htmlspecialchars($req_package_name); ?>»</strong>.<br/>
                    Бажаєте отримати повний доступ та відкрити додаткові платформи?
                </p>

                <div class="user-badge-bar">
                    <span>Ви увійшли як: <strong><?php echo htmlspecialchars($user['email']); ?></strong></span>
                    <span style="color:#6E6FFF; font-weight:600;">Поточний: <?php echo htmlspecialchars($user_package_name); ?></span>
                </div>

                <a href="index.php#tariffs" class="btn-upgrade">
                    Покращити тариф (<?php echo number_format($req_price, 0, '', ' '); ?> грн) ↗
                </a>

                <div>
                    <a href="<?php echo htmlspecialchars($packages[$user_level]['page'] ?? 'paket-1.php'); ?>" class="back-link">
                        ← Повернутися до мого тарифу (<?php echo htmlspecialchars($user_package_name); ?>)
                    </a>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    return $user;
}
