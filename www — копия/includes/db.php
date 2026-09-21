<?php
// includes/db.php - Database connection & schema setup

function get_db(): PDO {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $db_dir = __DIR__ . '/../data';
    if (!is_dir($db_dir)) {
        mkdir($db_dir, 0755, true);
    }

    $db_path = $db_dir . '/database.sqlite';
    $init = !file_exists($db_path);

    $pdo = new PDO('sqlite:' . $db_path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Initialize tables if needed
    if ($init || true) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL,
                name TEXT DEFAULT '',
                phone TEXT DEFAULT '',
                package_level INTEGER DEFAULT 1,
                status TEXT DEFAULT 'ACTIVE',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                last_login_at DATETIME DEFAULT NULL
            );

            CREATE TABLE IF NOT EXISTS orders (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                order_ref TEXT UNIQUE NOT NULL,
                package_id INTEGER NOT NULL,
                package_name TEXT NOT NULL,
                amount REAL NOT NULL,
                customer_email TEXT NOT NULL,
                customer_name TEXT DEFAULT '',
                customer_phone TEXT DEFAULT '',
                status TEXT DEFAULT 'PENDING',
                payment_gateway TEXT DEFAULT 'novapay',
                gateway_order_id TEXT DEFAULT '',
                paid_at DATETIME DEFAULT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS email_logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                recipient TEXT NOT NULL,
                subject TEXT NOT NULL,
                body_html TEXT NOT NULL,
                credentials_login TEXT NOT NULL,
                credentials_pass TEXT NOT NULL,
                sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                status TEXT DEFAULT 'SENT'
            );
        ");
    }

    return $pdo;
}

// Packages specification
function get_packages_config(): array {
    return [
        1 => [
            'id' => 1,
            'name' => 'Пакет 1. Базовий: Сайти Європи та Америки',
            'short_name' => 'Пакет 1. Базовий',
            'price' => 890.00,
            'page' => 'paket-1.php',
            'desc' => 'Список перевірених сайтів Європи, інструкції, реєстрація в логістичній компанії, топ-7 сайтів'
        ],
        2 => [
            'id' => 2,
            'name' => 'Пакет 2. Стандарт: Китай та Корея',
            'short_name' => 'Пакет 2. Стандарт',
            'price' => 1330.00,
            'page' => 'paket-2.php',
            'desc' => 'Все з Базового + платформи Китай та Корея, посилання на товари, відмінності копій від оригіналу, підтримка в чаті'
        ],
        3 => [
            'id' => 3,
            'name' => 'Пакет 3. VIP: Особистий супровід',
            'short_name' => 'Пакет 3. VIP',
            'price' => 3290.00,
            'page' => 'paket-3.php',
            'desc' => 'Все зі Стандарту + особиста консультація, допомога з першим замовленням, повний супровід'
        ]
    ];
}
