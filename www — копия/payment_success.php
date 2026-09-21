<?php
// payment_success.php - Thank you page after successful NovaPay payment

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

$order_ref = trim($_GET['order_ref'] ?? '');
$order = null;
$email_log = null;

if (!empty($order_ref)) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM orders WHERE order_ref = :ref LIMIT 1");
    $stmt->execute([':ref' => $order_ref]);
    $order = $stmt->fetch();

    if ($order) {
        $stmt_log = $db->prepare("SELECT * FROM email_logs WHERE recipient = :email ORDER BY id DESC LIMIT 1");
        $stmt_log->execute([':email' => $order['customer_email']]);
        $email_log = $stmt_log->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата успішна | Курс «Вигідні покупки»</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        * { box-sizing: border-box; }
        body { background: #F3F1E7; font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; }
        .success-box { background: #FFFFFF; max-width: 580px; width: 100%; border-radius: 28px; padding: 48px 40px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.06); border: 2px solid #DDD9E3; }
        .success-icon { width: 84px; height: 84px; background: #E8F5E9; color: #2E7D32; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px; }
        .success-icon svg { width: 44px; height: 44px; }
        .success-title { font-family: 'Oswald', sans-serif; font-size: 34px; text-transform: uppercase; color: #191BDF; margin: 0 0 12px; letter-spacing: 0.5px; }
        .success-desc { font-size: 15.5px; color: #4A4850; line-height: 1.6; margin-bottom: 28px; }
        .creds-card { background: #F6F4FB; border: 2px dashed #191BDF; border-radius: 16px; padding: 20px 24px; text-align: left; margin-bottom: 28px; }
        .creds-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid rgba(25, 27, 223, 0.1); font-size: 14.5px; }
        .creds-row:last-child { border-bottom: none; }
        .creds-label { color: #6E6FFF; font-weight: 600; }
        .creds-value { font-family: monospace; font-size: 16px; font-weight: 700; color: #191BDF; background: #FFFFFF; padding: 4px 10px; border-radius: 6px; border: 1px solid #D5D2E8; }
        .btn-enter { display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; background: #191BDF; color: #FFFFFF !important; padding: 18px; border-radius: 50px; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none; box-shadow: 0 10px 25px rgba(25, 27, 223, 0.25); transition: transform 0.2s; }
        .btn-enter:hover { transform: translateY(-2px); }
        .info-tip { margin-top: 20px; font-size: 13.5px; color: #718096; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="success-box">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>
        <h1 class="success-title">Оплату успішно зараховано!</h1>
        <p class="success-desc">
            Вітаємо! Ваш доступ до курсу <strong>«<?php echo htmlspecialchars($order['package_name'] ?? 'Вигідні покупки'); ?>»</strong> активовано.
            <br/>
            Ми вже надіслали лист із логіном та паролем на пошту <strong><?php echo htmlspecialchars($order['customer_email'] ?? ''); ?></strong>.
        </p>

        <?php if ($email_log): ?>
            <!-- Credentials preview for instant testing convenience -->
            <div class="creds-card">
                <div class="creds-row">
                    <span class="creds-label">Логін (Email):</span>
                    <span class="creds-value"><?php echo htmlspecialchars($email_log['credentials_login']); ?></span>
                </div>
                <div class="creds-row">
                    <span class="creds-label">Пароль для входу:</span>
                    <span class="creds-value"><?php echo htmlspecialchars($email_log['credentials_pass']); ?></span>
                </div>
                <div class="creds-row">
                    <span class="creds-label">Куплений тариф:</span>
                    <strong style="color: #191BDF;"><?php echo htmlspecialchars($order['package_name'] ?? 'Пакет 1'); ?></strong>
                </div>
            </div>
        <?php endif; ?>

        <a href="login.php<?php echo !empty($order['customer_email']) ? '?email=' . urlencode($order['customer_email']) : ''; ?>" class="btn-enter">
            Увійти до особистого кабінету ↗
        </a>

        <div class="info-tip">
            💡 Якщо лист не надійшов протягом кількох хвилин, обов’язково перевірте папку «Спам» або «Промоакції».
        </div>
    </div>
</body>
</html>
