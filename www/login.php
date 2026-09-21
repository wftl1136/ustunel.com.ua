<?php
// login.php - Student login portal for course packages

require_once __DIR__ . '/includes/auth.php';

$error = '';
$notice = '';

if (isset($_GET['notice'])) {
    if ($_GET['notice'] === 'auth_required') {
        $notice = 'Будь ласка, увійдіть за даними з листа, щоб отримати доступ до матеріалів.';
    } elseif ($_GET['notice'] === 'logged_out') {
        $notice = 'Ви успішно вийшли з особистого кабінету.';
    }
}

$redirect = trim($_GET['redirect'] ?? '');
$email_val = trim($_GET['email'] ?? '');

// If already logged in, redirect to purchased package
$current_user = get_current_user_data();
if ($current_user) {
    $packages = get_packages_config();
    $target_page = $packages[$current_user['package_level']]['page'] ?? 'paket-1.php';
    header("Location: " . (!empty($redirect) ? $redirect : $target_page));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $redirect = trim($_POST['redirect'] ?? '');
    $email_val = $email;

    $res = login_user($email, $password);
    if ($res['success']) {
        $user = $res['user'];
        $packages = get_packages_config();
        $target_page = $packages[$user['package_level']]['page'] ?? 'paket-1.php';
        $dest = (!empty($redirect) && strpos($redirect, 'http') === false) ? $redirect : $target_page;
        header("Location: " . $dest);
        exit;
    } else {
        $error = $res['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід до особистого кабінету | Курс «Вигідні покупки»</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        * { box-sizing: border-box; }
        body { background: #F3F1E7; font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; color: #1E1E24; }
        .login-card { background: #FFFFFF; max-width: 440px; width: 100%; border-radius: 28px; padding: 44px 36px; box-shadow: 0 20px 50px rgba(0,0,0,0.06); border: 2px solid #DDD9E3; text-align: center; }
        .login-logo { display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; background: #191BDF; border-radius: 50%; margin-bottom: 20px; color: #FFFFFF; box-shadow: 0 8px 20px rgba(25,27,223,0.25); }
        .login-logo svg { width: 36px; height: 36px; }
        .login-title { font-family: 'Oswald', sans-serif; font-size: 32px; text-transform: uppercase; color: #191BDF; margin: 0 0 6px; letter-spacing: 0.5px; }
        .login-subtitle { font-size: 14.5px; color: #6E6FFF; margin-bottom: 26px; font-weight: 500; }
        
        .alert-box { padding: 12px 16px; border-radius: 12px; font-size: 13.5px; margin-bottom: 20px; text-align: left; line-height: 1.45; }
        .alert-error { background: #FEE2E2; color: #991B1B; border: 1px solid #F87171; }
        .alert-notice { background: #E0E7FF; color: #3730A3; border: 1px solid #818CF8; }
        
        .form-group { text-align: left; margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #4A4850; margin-bottom: 6px; }
        .form-input { width: 100%; padding: 14px 16px; border: 1.5px solid #DDD9E3; border-radius: 14px; font-size: 15px; font-family: inherit; outline: none; transition: border-color 0.2s, background 0.2s; background: #FAF9F6; }
        .form-input:focus { border-color: #191BDF; background: #FFFFFF; }
        
        .btn-submit { width: 100%; background: #191BDF; color: #FFFFFF; border: none; padding: 16px; border-radius: 50px; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; transition: transform 0.15s, background 0.2s; margin-top: 8px; box-shadow: 0 10px 25px rgba(25, 27, 223, 0.25); }
        .btn-submit:hover { background: #1416B8; transform: translateY(-2px); }
        
        .login-footer { margin-top: 26px; font-size: 13.5px; color: #718096; }
        .login-footer a { color: #191BDF; text-decoration: none; font-weight: 600; }
        .login-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>

        <h1 class="login-title">Вхід до курсу</h1>
        <div class="login-subtitle">Особистий кабінет учня</div>

        <?php if (!empty($error)): ?>
            <div class="alert-box alert-error">
                ⚠️ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($notice)): ?>
            <div class="alert-box alert-notice">
                ℹ️ <?php echo htmlspecialchars($notice); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>" />

            <div class="form-group">
                <label class="form-label" for="email">Email (Логін):</label>
                <input type="email" id="email" name="email" class="form-input" required placeholder="your@email.com" value="<?php echo htmlspecialchars($email_val); ?>" autocomplete="email" />
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Пароль із листа:</label>
                <input type="password" id="password" name="password" class="form-input" required placeholder="Введіть пароль" autocomplete="current-password" />
            </div>

            <button type="submit" class="btn-submit">Увійти до курсу ↗</button>
        </form>

        <div class="login-footer">
            Ще не маєте доступу? <a href="index.php#tariffs">Вибрати тариф на сайті</a><br/>
            <div style="margin-top: 10px;">
                <a href="index.php">← Повернутися на головну сторінку</a>
            </div>
        </div>
    </div>
</body>
</html>
