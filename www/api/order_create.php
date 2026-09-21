<?php
// api/order_create.php - Handles order initiation from frontend tariff card

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/novapay.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$raw_input = file_get_contents('php://input');
$data = json_decode($raw_input, true) ?? $_POST;

$package_id = (int)($data['package_id'] ?? 0);
$customer_email = trim(mb_strtolower($data['email'] ?? ''));
$customer_name = trim($data['name'] ?? '');
$customer_phone = trim($data['phone'] ?? '');

$packages = get_packages_config();

if (!isset($packages[$package_id])) {
    echo json_encode(['success' => false, 'error' => 'Невірний вибір тарифного плану']);
    exit;
}

if (empty($customer_email) || !filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Введіть коректний Email (на нього надійдуть доступи до курсу)']);
    exit;
}

$package_info = $packages[$package_id];
$order_ref = 'ORD-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));

try {
    $db = get_db();
    $stmt = $db->prepare("
        INSERT INTO orders (order_ref, package_id, package_name, amount, customer_email, customer_name, customer_phone, status, payment_gateway)
        VALUES (:ref, :pkg_id, :pkg_name, :amount, :email, :name, :phone, 'PENDING', 'novapay')
    ");
    $stmt->execute([
        ':ref' => $order_ref,
        ':pkg_id' => $package_id,
        ':pkg_name' => $package_info['name'],
        ':amount' => $package_info['price'],
        ':email' => $customer_email,
        ':name' => $customer_name,
        ':phone' => $customer_phone
    ]);

    $order = [
        'id' => $db->lastInsertId(),
        'order_ref' => $order_ref,
        'package_id' => $package_id,
        'package_name' => $package_info['name'],
        'amount' => $package_info['price'],
        'customer_email' => $customer_email,
        'customer_name' => $customer_name,
        'customer_phone' => $customer_phone
    ];

    $redirect_url = NovaPayService::create_payment_url($order);

    echo json_encode([
        'success' => true,
        'order_ref' => $order_ref,
        'redirect_url' => $redirect_url
    ]);
} catch (Exception $e) {
    error_log("Order creation failed: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Не вдалося створити замовлення. Будь ласка, спробуйте ще раз.'
    ]);
}
