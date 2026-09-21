<?php
// novapay_checkout.php - Realistic NovaPay Payment Gateway Test Simulator

require_once __DIR__ . '/includes/db.php';

$order_ref = trim($_GET['order_ref'] ?? '');
if (empty($order_ref)) {
    header("Location: index.php");
    exit;
}

$db = get_db();
$stmt = $db->prepare("SELECT * FROM orders WHERE order_ref = :ref LIMIT 1");
$stmt->execute([':ref' => $order_ref]);
$order = $stmt->fetch();

if (!$order) {
    die("Замовлення не знайдено.");
}

// If already paid, redirect straight to success
if ($order['status'] === 'PAID') {
    header("Location: payment_success.php?order_ref=" . urlencode($order_ref));
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата замовлення | NovaPay</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #F4F5F7; font-family: 'Inter', sans-serif; color: #172B4D; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .checkout-box { background: #FFFFFF; max-width: 480px; width: 100%; border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); overflow: hidden; border: 1px solid #E2E8F0; }
        
        /* NovaPay Header */
        .np-header { background: #E11C38; padding: 24px 28px; display: flex; align-items: center; justify-content: space-between; color: #FFFFFF; }
        .np-brand { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 22px; letter-spacing: -0.5px; }
        .np-badge { background: rgba(255, 255, 255, 0.2); padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        
        /* Order Summary */
        .order-summary { padding: 24px 28px; border-bottom: 1px solid #EDF2F7; background: #FAFAFC; }
        .summary-label { font-size: 12.5px; color: #718096; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: 6px; }
        .summary-amount { font-size: 32px; font-weight: 800; color: #1A202C; }
        .summary-details { margin-top: 14px; font-size: 13.5px; color: #4A5568; line-height: 1.6; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        
        /* Payment Form */
        .payment-form { padding: 24px 28px; }
        .form-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #4A5568; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #4A5568; margin-bottom: 6px; }
        .form-input { width: 100%; padding: 12px 14px; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 15px; font-family: inherit; transition: border-color 0.2s; outline: none; background: #F8FAFC; }
        .form-input:focus { border-color: #E11C38; background: #FFFFFF; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        
        /* Simulator Notice */
        .test-notice { background: #FEF3C7; border: 1px solid #F59E0B; border-radius: 10px; padding: 12px 16px; font-size: 13px; color: #92400E; margin-bottom: 20px; line-height: 1.45; }
        
        /* Pay Button */
        .btn-pay { width: 100%; background: #E11C38; color: #FFFFFF; border: none; padding: 16px; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; transition: background 0.2s, transform 0.1s; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 8px 18px rgba(225, 28, 56, 0.28); }
        .btn-pay:hover { background: #C5142E; transform: translateY(-1px); }
        .btn-pay:active { transform: translateY(1px); }
        
        /* Cancel Button */
        .cancel-link { display: block; text-align: center; margin-top: 14px; font-size: 13.5px; color: #718096; text-decoration: none; }
        .cancel-link:hover { color: #E11C38; text-decoration: underline; }
        
        /* Loading Overlay */
        .loading-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.92); z-index: 100; flex-direction: column; align-items: center; justify-content: center; }
        .spinner { width: 50px; height: 50px; border: 4px solid #E2E8F0; border-top-color: #E11C38; border-radius: 50%; animation: spin 0.8s linear infinite; }
        .loading-text { margin-top: 18px; font-size: 16px; font-weight: 600; color: #1A202C; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="checkout-box">
        <!-- Header -->
        <div class="np-header">
            <div class="np-brand">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.8L19.5 8 12 11.2 4.5 8 12 4.8zM4 9.5l7 3.1v6.9l-7-3.5V9.5zm9 10v-6.9l7-3.1v6.5l-7 3.5z"/>
                </svg>
                <span>NovaPay</span>
            </div>
            <div class="np-badge">Тестовий режим</div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <div class="summary-label">До сплати:</div>
            <div class="summary-amount"><?php echo number_format($order['amount'], 2, '.', ' '); ?> ₴</div>
            <div class="summary-details">
                <div class="summary-row">
                    <span>Тариф:</span>
                    <strong><?php echo htmlspecialchars($order['package_name']); ?></strong>
                </div>
                <div class="summary-row">
                    <span>Покупець:</span>
                    <span><?php echo htmlspecialchars($order['customer_email']); ?></span>
                </div>
                <div class="summary-row">
                    <span>Номер замовлення:</span>
                    <code><?php echo htmlspecialchars($order['order_ref']); ?></code>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="payment-form">
            <div class="test-notice">
                ⚙️ <strong>Тестова оплата:</strong> Списання коштів не відбувається. Натисніть кнопку нижче, щоб симулювати успішну транзакцію в NovaPay, отримати доступ та лист на пошту.
            </div>

            <form id="paymentForm" onsubmit="processPayment(event)">
                <div class="form-group">
                    <label class="form-label">Номер банківської картки</label>
                    <input type="text" class="form-input" value="4441 •••• •••• 1234" readonly />
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Термін дії</label>
                        <input type="text" class="form-input" value="12 / 28" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-input" value="•••" readonly />
                    </div>
                </div>

                <button type="submit" class="btn-pay" id="payBtn">
                    <span>Сплатити <?php echo number_format($order['amount'], 2, '.', ' '); ?> ₴</span>
                    <span>→</span>
                </button>

                <a href="index.php#tariffs" class="cancel-link">Скасувати та повернутися на сайт</a>
            </form>
        </div>
    </div>

    <!-- Processing Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <div class="loading-text">Обробка платежу через NovaPay...</div>
        <div style="color:#718096; font-size:13.5px; margin-top:8px;">Створення облікового запису та відправка пароля на пошту</div>
    </div>

    <script>
        function processPayment(e) {
            e.preventDefault();
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('payBtn').disabled = true;

            // Send callback trigger
            fetch('api/payment_callback.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    order_ref: '<?php echo $order['order_ref']; ?>',
                    status: 'success',
                    test_mode: true
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'payment_success.php?order_ref=' + encodeURIComponent('<?php echo $order['order_ref']; ?>');
                } else {
                    alert('Помилка оплати: ' + (data.error || 'Невідома помилка'));
                    document.getElementById('loadingOverlay').style.display = 'none';
                    document.getElementById('payBtn').disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Помилка з’єднання з платіжним сервером');
                document.getElementById('loadingOverlay').style.display = 'none';
                document.getElementById('payBtn').disabled = false;
            });
        }
    </script>
</body>
</html>
