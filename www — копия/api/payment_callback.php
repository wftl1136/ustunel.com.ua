<?php
// api/payment_callback.php - Webhook handler: verifies payment, creates user & sends credentials email

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/mailer.php';
require_once __DIR__ . '/novapay.php';

$raw_input = file_get_contents('php://input');
$data = json_decode($raw_input, true) ?? $_POST;

$order_ref = trim($data['order_ref'] ?? ($data['metadata']['order_ref'] ?? ''));

if (empty($order_ref)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Відсутній order_ref']);
    exit;
}

// Check live signature if in live mode
$signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
if (!NovaPayService::TEST_MODE && !NovaPayService::verify_callback_signature($raw_input, $signature)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Невірна сигнатура платежу']);
    exit;
}

try {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM orders WHERE order_ref = :ref LIMIT 1");
    $stmt->execute([':ref' => $order_ref]);
    $order = $stmt->fetch();

    if (!$order) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Замовлення не знайдено']);
        exit;
    }

    // If order was already processed
    if ($order['status'] === 'PAID') {
        echo json_encode(['success' => true, 'message' => 'Замовлення вже оплачено']);
        exit;
    }

    $customer_email = trim(mb_strtolower($order['customer_email']));
    $customer_name = trim($order['customer_name']);
    $package_id = (int)$order['package_id'];
    $package_name = $order['package_name'];

    // 1. Mark order as PAID
    $gateway_id = $data['payment_id'] ?? ('NP-TEST-' . bin2hex(random_bytes(4)));
    $update_order = $db->prepare("
        UPDATE orders 
        SET status = 'PAID', paid_at = CURRENT_TIMESTAMP, gateway_order_id = :gw_id 
        WHERE id = :id
    ");
    $update_order->execute([':gw_id' => $gateway_id, ':id' => $order['id']]);

    // 2. Generate random password
    $raw_password = generate_random_password(10);
    $password_hash = password_hash($raw_password, PASSWORD_DEFAULT);

    // 3. Create or update user in database
    $stmt_user = $db->prepare("SELECT id, package_level FROM users WHERE email = :email LIMIT 1");
    $stmt_user->execute([':email' => $customer_email]);
    $existing_user = $stmt_user->fetch();

    if ($existing_user) {
        // Upgrade user package if purchased higher
        $new_level = max((int)$existing_user['package_level'], $package_id);
        $update_u = $db->prepare("
            UPDATE users 
            SET package_level = :lvl, password_hash = :hash, status = 'ACTIVE' 
            WHERE id = :id
        ");
        $update_u->execute([
            ':lvl' => $new_level,
            ':hash' => $password_hash,
            ':id' => $existing_user['id']
        ]);
    } else {
        // Create new user
        $insert_u = $db->prepare("
            INSERT INTO users (email, password_hash, name, phone, package_level, status)
            VALUES (:email, :hash, :name, :phone, :lvl, 'ACTIVE')
        ");
        $insert_u->execute([
            ':email' => $customer_email,
            ':hash' => $password_hash,
            ':name' => $customer_name,
            ':phone' => $order['customer_phone'] ?? '',
            ':lvl' => $package_id
        ]);
    }

    // 4. Send email with credentials
    send_credentials_email($customer_email, $customer_name, $package_name, $raw_password);

    echo json_encode([
        'success' => true,
        'message' => 'Оплата успішно зарахована. Обліковий запис створено, доступи відправлено на пошту.',
        'order_ref' => $order_ref,
        'email' => $customer_email
    ]);
} catch (Exception $e) {
    error_log("Payment callback error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Помилка обробки платежу']);
}
