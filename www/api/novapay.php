<?php
// api/novapay.php - NovaPay Payment Gateway Service (Production Ready + Test Simulator)

require_once __DIR__ . '/../includes/db.php';

class NovaPayService {
    // Set to false when live production credentials from NovaPay are provided
    public const TEST_MODE = true;

    // Production Credentials placeholder (fill with real merchant details when ready)
    private const LIVE_MERCHANT_ID = 'YOUR_NOVAPAY_MERCHANT_ID';
    private const LIVE_API_URL = 'https://api-gateway.novapay.ua/v1/session';
    private const LIVE_PUBLIC_KEY = '';
    private const LIVE_PRIVATE_KEY = '';

    /**
     * Creates a payment session for the order
     */
    public static function create_payment_url(array $order): string {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? '127.0.0.1:8088';
        $base_url = $protocol . $host;

        if (self::TEST_MODE) {
            // In test mode: redirect to internal NovaPay payment simulator page
            return $base_url . '/novapay_checkout.php?order_ref=' . urlencode($order['order_ref']);
        }

        // Live NovaPay API integration
        $payload = [
            'merchant_id' => self::LIVE_MERCHANT_ID,
            'client_first_name' => $order['customer_name'] ?? 'Учень',
            'client_last_name' => '',
            'client_email' => $order['customer_email'],
            'client_phone' => $order['customer_phone'] ?? '',
            'metadata' => [
                'order_ref' => $order['order_ref'],
                'package_id' => $order['package_id']
            ],
            'payment' => [
                'amount' => number_format($order['amount'], 2, '.', ''),
                'currency' => 'UAH',
                'description' => 'Оплата курсу: ' . $order['package_name']
            ],
            'redirect_url' => $base_url . '/payment_success.php?order_ref=' . urlencode($order['order_ref']),
            'callback_url' => $base_url . '/api/payment_callback.php'
        ];

        // Call live NovaPay API
        $ch = curl_init(self::LIVE_API_URL);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-Merchant-Id: ' . self::LIVE_MERCHANT_ID
            ],
            CURLOPT_TIMEOUT => 20
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            error_log("NovaPay API cURL error: " . $err);
            throw new Exception("Не вдалося підключитися до платіжного шлюзу NovaPay");
        }

        $res_data = json_decode($response, true);
        if (!empty($res_data['checkout_url'])) {
            return $res_data['checkout_url'];
        }

        error_log("NovaPay API failed response: " . $response);
        throw new Exception("Помилка ініціалізації платежу NovaPay");
    }

    /**
     * Validates live webhook signature from NovaPay
     */
    public static function verify_callback_signature(string $raw_body, string $signature): bool {
        if (self::TEST_MODE) {
            return true;
        }

        if (empty(self::LIVE_PUBLIC_KEY) || empty($signature)) {
            return false;
        }

        $public_key = openssl_pkey_get_public(self::LIVE_PUBLIC_KEY);
        if (!$public_key) {
            return false;
        }

        $ok = openssl_verify($raw_body, base64_decode($signature), $public_key, OPENSSL_ALGO_SHA256);
        return ($ok === 1);
    }
}
