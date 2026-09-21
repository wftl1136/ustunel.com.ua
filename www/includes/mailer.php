<?php
// includes/mailer.php - Automated email generation & dispatching via PHPMailer + SMTP

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/smtp_config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

/**
 * Generates a strong, user-friendly random password
 */
function generate_random_password(int $length = 10): string {
    $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%';
    $password = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, $max)];
    }
    return $password;
}

/**
 * Sends welcome email with credentials to the customer after successful payment
 */
function send_credentials_email(string $recipient_email, string $customer_name, string $package_name, string $password, string $login_url = ''): bool {
    if (empty($login_url)) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'ustunel.com.ua';
        $login_url = $protocol . $host . '/login.php';
    }

    $subject = "Ваш доступ до курсу «Вигідні покупки»: " . $package_name;

    // Responsive, high-converting HTML Email Template
    $body_html = '
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . htmlspecialchars($subject) . '</title>
        <style>
            body { margin: 0; padding: 0; background-color: #F3F1E7; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #1E1E24; }
            .email-wrapper { max-width: 600px; margin: 30px auto; background: #FFFFFF; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #DDD9E3; }
            .email-header { background: #191BDF; padding: 36px 30px; text-align: center; color: #FFFFFF; }
            .email-header h1 { margin: 0; font-size: 26px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; }
            .email-header p { margin: 8px 0 0; font-size: 15px; opacity: 0.9; }
            .email-body { padding: 36px 32px; }
            .greeting { font-size: 18px; font-weight: 700; margin-bottom: 16px; color: #191BDF; }
            .intro-text { font-size: 15px; line-height: 1.6; color: #4A4850; margin-bottom: 24px; }
            .creds-box { background: #F6F4FB; border: 2px dashed #191BDF; border-radius: 14px; padding: 22px 24px; margin: 24px 0; }
            .creds-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid rgba(25,27,223,0.1); font-size: 15px; }
            .creds-row:last-child { border-bottom: none; }
            .creds-label { font-weight: 600; color: #5B5866; }
            .creds-val { font-family: monospace; font-size: 16px; font-weight: 700; color: #191BDF; background: #FFFFFF; padding: 4px 10px; border-radius: 6px; border: 1px solid #D5D2E8; }
            .btn-container { text-align: center; margin: 32px 0 20px; }
            .login-btn { display: inline-block; background: #191BDF; color: #FFFFFF !important; text-decoration: none; padding: 16px 36px; border-radius: 50px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 8px 20px rgba(25,27,223,0.25); }
            .notice-box { background: #FFF9E6; border-left: 4px solid #FFC107; padding: 14px 18px; border-radius: 8px; font-size: 13.5px; color: #7A6000; line-height: 1.5; margin: 24px 0; }
            .email-footer { background: #FAF9F6; padding: 22px 30px; text-align: center; font-size: 12.5px; color: #8C8894; border-top: 1px solid #EAE7EE; }
            .email-footer a { color: #191BDF; text-decoration: none; font-weight: 600; }
        </style>
    </head>
    <body>
        <div class="email-wrapper">
            <div class="email-header">
                <h1>Вигідні покупки</h1>
                <p>Особистий кабінет учня курсу</p>
            </div>
            <div class="email-body">
                <div class="greeting">Вітаємо' . (!empty($customer_name) ? ', ' . htmlspecialchars($customer_name) : '') . '! 🎉</div>
                <div class="intro-text">
                    Вашу оплату успішно зараховано! Вам відкрито доступ до матеріалів курсу <strong>«' . htmlspecialchars($package_name) . '»</strong>.
                    <br/><br/>
                    Для входу в ваш особистий кабінет було автоматично створено обліковий запис:
                </div>

                <div class="creds-box">
                    <div class="creds-row">
                        <span class="creds-label">Логін (Email):</span>
                        <span class="creds-val">' . htmlspecialchars($recipient_email) . '</span>
                    </div>
                    <div class="creds-row">
                        <span class="creds-label">Пароль:</span>
                        <span class="creds-val">' . htmlspecialchars($password) . '</span>
                    </div>
                    <div class="creds-row">
                        <span class="creds-label">Ваш тариф:</span>
                        <span style="font-weight:700; color:#191BDF;">' . htmlspecialchars($package_name) . '</span>
                    </div>
                </div>

                <div class="btn-container">
                    <a href="' . htmlspecialchars($login_url) . '" class="login-btn" target="_blank">Увійти до курсу ↗</a>
                </div>

                <div class="notice-box">
                    💡 <strong>Порада:</strong> Збережіть цей лист або запишіть свій пароль. Після першого входу ви завжди зможете змінити пароль у кабінеті.
                </div>
            </div>
            <div class="email-footer">
                З повагою, команда курсу «Вигідні покупки»<br/>
                Зворотній зв\'язок: <a href="https://t.me/+DJ8At29MEy0xMzMy" target="_blank">Підтримка в Telegram</a>
            </div>
        </div>
    </body>
    </html>
    ';

    $mail_sent = false;
    $mail_error = '';

    // ── PHPMailer via SMTP ────────────────────────────────────────────────────
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->Port       = SMTP_PORT;

        // Encryption
        if (SMTP_ENCRYPTION === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        // Sender & recipient
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($recipient_email, $customer_name);
        $mail->addReplyTo('support@ustunel.com.ua', 'Підтримка');

        // Content
        $mail->CharSet  = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body_html;
        $mail->AltBody = "Вітаємо, {$customer_name}!\n\nВаш доступ до курсу «{$package_name}»:\nЛогін: {$recipient_email}\nПароль: {$password}\n\nВхід: {$login_url}";

        $mail->send();
        $mail_sent = true;

    } catch (PHPMailerException $e) {
        $mail_error = $e->getMessage();
        error_log("PHPMailer error for {$recipient_email}: " . $mail_error);
    }

    // ── Always log to database & JSON ────────────────────────────────────────
    try {
        $db = get_db();
        $stmt = $db->prepare("
            INSERT INTO email_logs (recipient, subject, body_html, credentials_login, credentials_pass, status)
            VALUES (:recipient, :subject, :body_html, :login, :pass, :status)
        ");
        $stmt->execute([
            ':recipient' => $recipient_email,
            ':subject'   => $subject,
            ':body_html' => $body_html,
            ':login'     => $recipient_email,
            ':pass'      => $password,
            ':status'    => $mail_sent ? 'SENT' : ('FAILED: ' . substr($mail_error, 0, 200))
        ]);

        // Append to json log
        $json_file = __DIR__ . '/../data/email_log.json';
        $log_data  = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];
        $log_data[] = [
            'time'      => date('Y-m-d H:i:s'),
            'recipient' => $recipient_email,
            'package'   => $package_name,
            'login'     => $recipient_email,
            'password'  => $password,
            'mail_sent' => $mail_sent,
            'error'     => $mail_error,
            'login_url' => $login_url
        ];
        file_put_contents($json_file, json_encode($log_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    } catch (Exception $e) {
        error_log("Email log error: " . $e->getMessage());
    }

    return $mail_sent;
}
