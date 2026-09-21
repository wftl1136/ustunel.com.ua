<?php
require_once __DIR__ . '/includes/auth.php';
$current_user = require_package(2);

// Load cards data from JSON
$cards_file = __DIR__ . '/img/course/cards_data_p2.json';
$all_cards = file_exists($cards_file) ? json_decode(file_get_contents($cards_file), true) : [];

// Group cards by section
$sections = [
    'p2_sec_01' => [
        'title' => '01 Китайські платформи',
        'intro' => [
            'Китайські платформи відкривають доступ до величезного вибору товарів — від одягу та взуття до аксесуарів і товарів для дому. Нижче зібрані основні майданчики, які варто знати для самостійних покупок.',
            'Рекомендую, першу реєстрацію на деяких платформах робити через комп\'ютер, використовуючи автоматичний переклад. Якщо ви робите реєстрацію в додатку, це трошки займе ваш час, але далі буде просто робити покупки.'
        ],
        'cards' => []
    ],
    'p2_sec_02' => [
        'title' => '02 Корейські платформи',
        'intro' => [
            'Корейські платформи особливо цікаві для покупки косметики, догляду, одягу та інших товарів безпосередньо з Південної Кореї. Тут зібрані основні сайти, з яких можна почати знайомство з корейським онлайн-шопінгом.'
        ],
        'cards' => []
    ]
];

foreach ($all_cards as $c) {
    $sec = $c['sec'] ?? 'p2_sec_01';
    if (isset($sections[$sec])) {
        $sections[$sec]['cards'][] = $c;
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Пакет 2. Стандарт: КИТАЙ ТА КОРЕЯ | Офіційний курс</title>
    <meta name="description" content="Пакет 2. Стандарт: Сайти Китаю та Кореї, платформи Pinduoduo, 1688, Taobao, Poizon, WeChat, Gmarket, StyleKorean, логістика Meest China та перше замовлення." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="css/main.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-1.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-2.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="course-body">

    <!-- Mobile Top Header Bar -->
    <div class="mobile-header-bar">
        <button class="mobile-menu-btn" id="mobileMenuToggle">☰ Модулі курсу</button>
        <div style="font-weight: 700; font-size: 13px; color: #1627EC;">ПАКЕТ 2: КИТАЙ ТА КОРЕЯ</div>
        <button class="topbar-btn" id="savedItemsBtnMobile" style="font-size: 13px;">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
            <span class="saved-counter" id="savedCountMobile">0</span>
        </button>
    </div>

    <div class="course-layout">
        <!-- ==========================================================================
             LEFT SIDEBAR NAVIGATION
             ========================================================================== -->
        <aside class="course-sidebar" id="courseSidebar">
            <div class="sidebar-card">
                <!-- User Profile -->
                <div class="sidebar-user" id="userProfileTrigger" title="Натисніть, щоб переглянути акаунт">
                    <div class="sidebar-avatar">
                        <img src="img/course/user_avatar.png" alt="<?php echo htmlspecialchars($current_user['name']); ?>" />
                    </div>
                    <div class="sidebar-user-info">
                        <span class="sidebar-user-label">МІЙ АКАУНТ</span>
                        <span class="sidebar-user-name"><?php echo htmlspecialchars($current_user['name']); ?></span>
                    </div>
                </div>

                <!-- Link to Package 1 -->
                <div class="sidebar-pkg-title" style="margin-bottom: 8px;">
                    <a href="paket-1.php" style="color: inherit; text-decoration: none; display: flex; align-items: center; justify-content: space-between;">
                        <span>ПАКЕТ 1. БАЗОВИЙ:<br/>ЄВРОПА ТА АМЕРИКА</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>

                <!-- Package 2 Title (Active) -->
                <div class="sidebar-pkg-title" style="color: #1627EC; margin-top: 14px; border-top: 1px solid #C4B1A0; padding-top: 14px;">
                    ПАКЕТ 2. СТАНДАРТ:<br/>КИТАЙ ТА КОРЕЯ
                </div>

                <!-- Navigation Accordion for Package 2 -->
                <nav class="sidebar-nav">
                    <!-- Module 4 -->
                    <div class="sidebar-mod open" id="mod4Accordion">
                        <button class="sidebar-mod-btn active-orange" onclick="toggleAccordion('mod4Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m1.png" class="mod-icon" alt="" />
                                <span>МОДУЛЬ 4.<br/>Платформи</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#p2_sec_01" class="sidebar-link active" data-target="p2_sec_01">01 Китайські платформи</a>
                            <a href="#p2_sec_02" class="sidebar-link" data-target="p2_sec_02">02 Корейські платформи</a>
                            <a href="#p2_sec_03" class="sidebar-link" data-target="p2_sec_03">03 Gmarket</a>
                            <a href="#p2_sec_04" class="sidebar-link" data-target="p2_sec_04">04 Pinduoduo</a>
                            <a href="#p2_sec_05" class="sidebar-link" data-target="p2_sec_05">05 WeChat</a>
                        </div>
                    </div>

                    <!-- Module 5 -->
                    <div class="sidebar-mod open" id="mod5Accordion">
                        <button class="sidebar-mod-btn mod-tan" onclick="toggleAccordion('mod5Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m2.png" class="mod-icon" alt="" />
                                <span>МОДУЛЬ 5.<br/>Логістика з Азії</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#p2_mod5_sec_01" class="sidebar-link" data-target="p2_mod5_sec_01">01 Реєстрація</a>
                            <a href="#p2_mod5_sec_02" class="sidebar-link" data-target="p2_mod5_sec_02">02 Meest China</a>
                            <a href="#p2_mod5_sec_03" class="sidebar-link" data-target="p2_mod5_sec_03">03 Реєстрація замовлення</a>
                        </div>
                    </div>

                    <!-- Module 6 -->
                    <div class="sidebar-mod open" id="mod6Accordion">
                        <button class="sidebar-mod-btn mod-tan" onclick="toggleAccordion('mod6Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m3.png" class="mod-icon" alt="" />
                                <span>МОДУЛЬ 6.<br/>Перше замовлення</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#p2_mod6_sec_01" class="sidebar-link" data-target="p2_mod6_sec_01">01 Gmarket</a>
                        </div>
                    </div>
                </nav>

                <!-- Bottom Upsell (Paket 3) -->
                <div class="sidebar-upsell-list" style="margin-top: 20px;">
                    <?php if ((int)$current_user['package_level'] >= 3): ?>
                        <div class="sidebar-upsell-card" style="background: rgba(241, 90, 36, 0.08); border-color: #F15A24;">
                            <div class="upsell-left">
                                <span style="color: #10B981; font-size: 16px; font-weight: 700;">✓</span>
                                <span class="upsell-title" style="color: #F15A24;">ПАКЕТ 3. VIP:<br/>ОСОБИСТИЙ СУПРОВІД</span>
                            </div>
                            <a href="paket-3.php" class="upsell-buy-btn" style="background: #F15A24;">ВХІД →</a>
                        </div>
                    <?php else: ?>
                        <div class="sidebar-upsell-card">
                            <div class="upsell-left">
                                <img src="img/course/icon_lock.png" class="upsell-lock-icon" alt="Lock" />
                                <span class="upsell-title">ПАКЕТ 3. VIP:<br/>ОСОБИСТИЙ СУПРОВІД</span>
                            </div>
                            <a href="index.php#tariffs" class="upsell-buy-btn">BUY ↗</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <!-- ==========================================================================
             MAIN CONTENT
             ========================================================================== -->
        <main class="course-main">
            <!-- Top Actions -->
            <div class="course-topbar">
                <button class="topbar-btn" id="savedItemsBtn">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    <span>Збережені</span>
                    <span class="saved-counter" id="savedCount">0</span>
                </button>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: #FFFFFF; border: 1px solid #DDD9E3; padding: 6px 14px; border-radius: 999px; font-size: 13px; color: #191BDF; font-weight: 600;">
                    <span style="width: 8px; height: 8px; background: #10B981; border-radius: 50%; display: inline-block;"></span>
                    <span><?php echo htmlspecialchars($current_user['email']); ?></span>
                </div>
                <a href="logout.php" class="topbar-btn" title="Вийти з особистого кабінету">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Вийти</span>
                </a>
            </div>

            <!-- ==========================================================================
                 MODULE 4: КИТАЙСЬКІ ТА КОРЕЙСЬКІ ПЛАТФОРМИ
                 ========================================================================== -->
            <div class="module-header" id="module_4">
                <div class="module-oval-container">
                    <h1 class="module-title">МОДУЛЬ 4. КИТАЙСЬКІ ПЛАТФОРМИ</h1>
                </div>
                <div class="module-subtitle">
                    У цьому модулі зібрані перевірені сайти Китаю та Кореї для вигідних покупок.<br/>
                    Для зручності всі платформи розподілені за категоріями.
                </div>
            </div>

            <!-- SECTION 01: Китайські платформи -->
            <section class="course-section" id="p2_sec_01">
                <h2 class="section-heading">01 Китайські платформи</h2>
                <div class="section-intro-text">
                    <p>Китайські платформи відкривають доступ до величезного вибору товарів — від одягу та взуття до аксесуарів і товарів для дому. Нижче зібрані основні майданчики, які варто знати для самостійних покупок.</p>
                    <p>Рекомендую, першу реєстрацію на деяких платформах робити через комп'ютер, використовуючи автоматичний переклад. Якщо ви робите реєстрацію в додатку, це трошки займе ваш час, але далі буде просто робити покупки.</p>
                </div>

                <div class="cards-grid">
                    <?php foreach ($sections['p2_sec_01']['cards'] as $card): ?>
                        <div class="site-card" id="card-<?php echo $card['id']; ?>" data-id="<?php echo $card['id']; ?>" data-title="<?php echo htmlspecialchars($card['title']); ?>" data-country="<?php echo htmlspecialchars($card['country']); ?>" data-badge="<?php echo htmlspecialchars($card['badge']); ?>" data-url="<?php echo htmlspecialchars($card['url']); ?>">
                            <!-- SVG Card Shape Background with Architectural Dome -->
                            <svg class="card-bg-svg" viewBox="0 0 369 259" fill="none" preserveAspectRatio="none">
                                <path class="card-bg-path" d="M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 L 339.00 37.00 C 355.57 37.00, 369.00 50.43, 369.00 67.00 L 369.00 229.00 C 369.00 245.57, 355.57 259.00, 339.00 259.00 L 30.00 259.00 C 13.43 259.00, 0.00 245.57, 0.00 229.00 L 0.00 67.00 C 0.00 50.43, 13.43 37.00, 30.00 37.00 C 37.71 37.00, 43.77 30.62, 47.02 23.62 C 53.45 9.76, 68.91 0.00, 86.96 0.00 Z" fill="#DDD9E3" stroke="#BDB8C7" stroke-width="1.5"/>
                            </svg>

                            <!-- Circular Logo Badge centered inside Dome -->
                            <div class="card-badge-wrap">
                                <img src="img/course/p2_badges/<?php echo htmlspecialchars($card['badge']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>" class="card-badge-img" loading="lazy" />
                            </div>

                            <!-- Top-Right Actions (Pill & Bookmark) -->
                            <div class="card-header-actions">
                                <span class="card-tag"><?php echo htmlspecialchars($card['tag']); ?></span>
                                <button class="card-bookmark-btn" onclick="toggleBookmark(<?php echo $card['id']; ?>)" title="Додати до збережених" aria-label="Зберегти">
                                    <svg viewBox="0 0 24 24" class="bookmark-icon" aria-hidden="true">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Card Content -->
                            <div class="card-content">
                                <h3 class="card-title"><?php echo htmlspecialchars($card['title']); ?></h3>
                                <?php if (!empty($card['country'])): ?>
                                    <div class="card-country">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/></svg>
                                        <span><?php echo htmlspecialchars($card['country']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <p class="card-desc"><?php echo htmlspecialchars($card['desc']); ?></p>
                                <a href="<?php echo htmlspecialchars($card['url']); ?>" target="_blank" rel="noopener noreferrer" class="card-link">
                                    <span class="card-link-text"><?php echo htmlspecialchars($card['url_text']); ?></span>
                                    <svg class="card-link-arrow" viewBox="0 0 10 10" width="10" height="10" fill="currentColor" aria-hidden="true">
                                        <path d="M 0.89 8.72 L 0.0 7.83 L 6.59 1.23 L 1.5 1.23 L 1.51 0.0 L 8.7 0.0 L 8.7 7.2 L 7.47 7.2 L 7.48 2.11 L 0.89 8.72 Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Decorative Crown from original Figma design (slot 6 in grid) -->
                    <div class="crown-decoration-p2-right">
                        <img src="img/course/p2/crown_right.png" alt="Crown decoration" />
                    </div>
                </div>
            </section>

            <!-- SECTION 02: Корейські платформи -->
            <section class="course-section" id="p2_sec_02">
                <h2 class="section-heading">02 Корейські платформи</h2>
                <div class="section-intro-text">
                    <p>Корейські платформи особливо цікаві для покупки косметики, догляду, одягу та інших товарів безпосередньо з Південної Кореї. Тут зібрані основні сайти, з яких можна почати знайомство з корейським онлайн-шопінгом.</p>
                </div>

                <div class="cards-grid">
                    <?php foreach ($sections['p2_sec_02']['cards'] as $card): ?>
                        <div class="site-card" id="card-<?php echo $card['id']; ?>" data-id="<?php echo $card['id']; ?>" data-title="<?php echo htmlspecialchars($card['title']); ?>" data-country="<?php echo htmlspecialchars($card['country']); ?>" data-badge="<?php echo htmlspecialchars($card['badge']); ?>" data-url="<?php echo htmlspecialchars($card['url']); ?>">
                            <!-- SVG Card Shape Background with Architectural Dome -->
                            <svg class="card-bg-svg" viewBox="0 0 369 259" fill="none" preserveAspectRatio="none">
                                <path class="card-bg-path" d="M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 L 339.00 37.00 C 355.57 37.00, 369.00 50.43, 369.00 67.00 L 369.00 229.00 C 369.00 245.57, 355.57 259.00, 339.00 259.00 L 30.00 259.00 C 13.43 259.00, 0.00 245.57, 0.00 229.00 L 0.00 67.00 C 0.00 50.43, 13.43 37.00, 30.00 37.00 C 37.71 37.00, 43.77 30.62, 47.02 23.62 C 53.45 9.76, 68.91 0.00, 86.96 0.00 Z" fill="#DDD9E3" stroke="#BDB8C7" stroke-width="1.5"/>
                            </svg>

                            <div class="card-badge-wrap">
                                <img src="img/course/p2_badges/<?php echo htmlspecialchars($card['badge']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>" class="card-badge-img" loading="lazy" />
                            </div>

                            <div class="card-header-actions">
                                <span class="card-tag"><?php echo htmlspecialchars($card['tag']); ?></span>
                                <button class="card-bookmark-btn" onclick="toggleBookmark(<?php echo $card['id']; ?>)" title="Додати до збережених" aria-label="Зберегти">
                                    <svg viewBox="0 0 24 24" class="bookmark-icon" aria-hidden="true">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="card-content">
                                <h3 class="card-title"><?php echo htmlspecialchars($card['title']); ?></h3>
                                <?php if (!empty($card['country'])): ?>
                                    <div class="card-country">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/></svg>
                                        <span><?php echo htmlspecialchars($card['country']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <p class="card-desc"><?php echo htmlspecialchars($card['desc']); ?></p>
                                <a href="<?php echo htmlspecialchars($card['url']); ?>" target="_blank" rel="noopener noreferrer" class="card-link">
                                    <span class="card-link-text"><?php echo htmlspecialchars($card['url_text']); ?></span>
                                    <svg class="card-link-arrow" viewBox="0 0 10 10" width="10" height="10" fill="currentColor" aria-hidden="true">
                                        <path d="M 0.89 8.72 L 0.0 7.83 L 6.59 1.23 L 1.5 1.23 L 1.51 0.0 L 8.7 0.0 L 8.7 7.2 L 7.47 7.2 L 7.48 2.11 L 0.89 8.72 Z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Decorative Crown on the Left -->
                <div class="crown-decoration-p2-left">
                    <img src="img/course/p2/crown_left.png" alt="Crown decoration" />
                </div>
            </section>

            <!-- SECTION 03: Gmarket -->
            <section class="course-section" id="p2_sec_03">
                <h2 class="section-heading">03 Gmarket</h2>
                <div class="section-intro-text">
                    <p><strong>Реєстрація на Gmarket:</strong> Покроково розберемо процес реєстрації на корейській платформі та підготуємо акаунт до оформлення першого замовлення.</p>
                </div>

                <!-- Video Mockup for Gmarket Registration -->
                <div class="phone-center-wrapper">
                    <img src="img/course/p2/phone_gmarket_reg.png" alt="Реєстрація на Gmarket" class="phone-mockup-p2" onclick="openVideoModal('Відеоінструкція: Реєстрація на Gmarket')" />
                </div>

                <!-- Special Block: Payment Registration via Email -->
                <div class="card-payment-box">
                    <h3 class="card-payment-title">ОПЛАТА КАРТКОЮ НА GMARKET</h3>
                    <div class="card-payment-desc">
                        Рекомендую використовувати внутрішню корейську версію сайту Gmarket, а не глобальну.<br/>
                        Перед оформленням замовлення потрібно надіслати лист на електронну пошту Gmarket, щоб вашу картку додали до платіжної системи. Це допоможе уникнути затримок під час обробки замовлення.
                    </div>
                    <div class="card-payment-example-title">
                        <span>Приклад листа (можна скопіювати):</span>
                        <button class="copy-btn" onclick="copyEmailTemplate(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            <span>Скопіювати</span>
                        </button>
                    </div>
                    <div class="card-payment-codeblock">
                        <pre id="emailTemplateText">"Hello,
I would like to register my card in the payment system.
My ID: [ваш ID]
My card number: 1234......5678 [ваш номер картки]
Please let me know if you need any additional information.
Thank you."</pre>
                    </div>
                    <div class="card-payment-email">
                        <span>Електронна пошта:</span>
                        <a href="mailto:gmk_cs@corp.gmarket.co.kr">gmk_cs@corp.gmarket.co.kr</a>
                    </div>
                </div>
            </section>

            <!-- SECTION 04: Pinduoduo -->
            <section class="course-section" id="p2_sec_04">
                <h2 class="section-heading">04 Pinduoduo</h2>
                <div class="section-intro-text">
                    <p><strong>Реєстрація на Pinduoduo:</strong> Розберемо процес створення акаунта та основні налаштування, необхідні для подальшої роботи з платформою.</p>
                </div>

                <!-- Side-by-side instruction grid -->
                <div class="pinduoduo-grid">
                    <!-- Left: Video Instruction -->
                    <div class="instruction-col">
                        <h3 class="instruction-col-title">ЯК КОРИСТУВАТИСЯ СЕРВІСОМ<br/>(ВІДЕОІНСТРУКЦІЯ)</h3>
                        <img src="img/course/p2/phone_pinduoduo_video.png" alt="Відеоінструкція Pinduoduo" class="phone-mockup-p2-side" onclick="openVideoModal('Відеоінструкція: Як користуватися Pinduoduo')" />
                    </div>

                    <!-- Right: Step Screenshots -->
                    <div class="instruction-col instruction-col-right">
                        <h3 class="instruction-col-title">ЯК КОРИСТУВАТИСЯ СЕРВІСОМ<br/>(СКРИНШОТИ)</h3>
                        <div class="instruction-steps-list">
                            <div class="instruction-step-item">
                                <div class="instruction-step-num">1. Реєстрація в додатку Pindoudou</div>
                                <div class="instruction-step-desc">
                                    Натискаємо на нижню кнопку з телефоном. Або якщо у вас є WeChat — то автоматично вас зареєструє.
                                    <div class="instruction-warning">Але !! Ми розглядаємо реєстрацію через номер телефону</div>
                                </div>
                            </div>
                        </div>
                        <img src="img/course/p2/phone_pinduoduo_screen1.png" alt="Скриншот реєстрації Pinduoduo" class="phone-mockup-p2-side" onclick="openVideoModal('Покрокова реєстрація Pinduoduo')" />
                    </div>
                </div>

                <!-- Intro to Pinduoduo -->
                <div style="margin-top: 40px;">
                    <h3 class="instruction-col-title" style="font-size: 28px;">Знайомство з Pinduoduo</h3>
                    <div class="section-intro-text">
                        <p>Розберемо особливості Pinduoduo, як працює платформа та чим вона може бути корисною для ваших покупок.</p>
                    </div>
                    <div class="phone-center-wrapper">
                        <img src="img/course/p2/phone_pinduoduo_intro.png" alt="Знайомство з Pinduoduo" class="phone-mockup-p2" onclick="openVideoModal('Знайомство з Pinduoduo')" />
                    </div>
                </div>
            </section>

            <!-- SECTION 05: WeChat -->
            <section class="course-section" id="p2_sec_05">
                <h2 class="section-heading">05 WeChat</h2>
                <div style="font-size: 18px; font-weight: 700; color: #1627EC; margin-bottom: 8px;">
                    Банківська картка у WeChat
                </div>
                <div class="section-intro-text">
                    <p>Покроково покажемо, де знайти платіжні налаштування та як додати банківську картку для подальшого використання під час покупок.</p>
                </div>
                <div class="phone-center-wrapper">
                    <img src="img/course/p2/phone_wechat.png" alt="Банківська картка у WeChat" class="phone-mockup-p2" onclick="openVideoModal('Банківська картка у WeChat')" />
                </div>
            </section>

            <!-- ==========================================================================
                 MODULE 5: ЛОГІСТИКА З АЗІЇ
                 ========================================================================== -->
            <div class="module-header" id="p2_mod5_sec_01" style="margin-top: 80px;">
                <div class="module-oval-container">
                    <h2 class="module-title">МОДУЛЬ 5. ЛОГІСТИКА З АЗІЇ</h2>
                </div>
                <div class="module-subtitle">
                    Для доставки покупок із Китаю та Південної Кореї необхідно правильно зареєструватися в логістичній компанії та додати оформлене замовлення. У цьому модулі розберемо обидва етапи.
                </div>
            </div>

            <!-- Module 5 Grid: Row 1 (01 Реєстрація + 02 Meest China) -->
            <div class="logistics-grid">
                <!-- Left: 01 Реєстрація -->
                <div class="logistics-col" id="p2_mod5_sec_01_sub">
                    <h3 class="instruction-col-title">01 РЕЄСТРАЦІЯ</h3>
                    <img src="img/course/p2/phone_meest_step1_girl.png" alt="Реєстрація Meest China" class="phone-mockup-p2-side" onclick="openVideoModal('Реєстрація в логістичній компанії з Азії')" />
                </div>

                <!-- Right: 02 Реєстрація в Meest China -->
                <div class="logistics-col logistics-col-staggered" id="p2_mod5_sec_02">
                    <h3 class="instruction-col-title">2 РЕЄСТРАЦІЯ В MEEST CHINA</h3>
                    <div class="section-intro-text">
                        <p>У відео покроково розберемо реєстрацію в додатку Meest China та основні налаштування, які знадобляться для подальших покупок і доставки.</p>
                    </div>
                    <img src="img/course/p2/phone_meest_step2_app.png" alt="Meest China App" class="phone-mockup-p2-side" onclick="openVideoModal('Реєстрація в додатку Meest China')" />
                </div>
            </div>

            <!-- Module 5 Grid: Row 2 (03 Реєстрація замовлення + Meest Landing Site) -->
            <div class="logistics-grid" id="p2_mod5_sec_03" style="margin-top: 60px;">
                <!-- Left: 03. Реєстрація замовлення -->
                <div class="logistics-col">
                    <h3 class="instruction-col-title">03. РЕЄСТРАЦІЯ ЗАМОВЛЕННЯ</h3>
                    <div class="section-intro-text">
                        <p>На практиці покажемо, як правильно додати вже оформлене замовлення в Meest China, заповнити необхідні дані та підготувати його до доставки.</p>
                    </div>
                    <img src="img/course/p2/phone_meest_step3_order.png" alt="Реєстрація замовлення Meest China" class="phone-mockup-p2-side" onclick="openVideoModal('Реєстрація замовлення в Meest China')" />
                </div>

                <!-- Right: Meest China Landing Platform -->
                <div class="logistics-col">
                    <div class="meest-landing-frame" onclick="openVideoModal('Оформлення доставки Meest China')">
                        <img src="img/course/p2/meest_site_landing.png" alt="Meest China Сайт" class="phone-mockup-p2-side" style="width: 100%; height: auto; border-radius: 24px;" />
                    </div>
                </div>
            </div>

            <!-- ==========================================================================
                 MODULE 6: ПЕРШЕ ЗАМОВЛЕННЯ
                 ========================================================================== -->
            <div class="module-header" id="p2_mod6_sec_01" style="margin-top: 80px;">
                <div class="module-oval-container">
                    <h2 class="module-title">МОДУЛЬ 6. ПЕРШЕ ЗАМОВЛЕННЯ</h2>
                </div>
                <div class="module-subtitle">
                    Переходимо до практики. У цьому модулі ви побачите весь процес оформлення першої покупки на китайських та корейських платформах — від роботи із застосунками до реєстрації замовлення в логістичній компанії.
                </div>
            </div>

            <!-- Sub 01: Gmarket -->
            <section class="course-section">
                <h3 class="section-heading">01 Gmarket</h3>
                <div class="section-intro-text">
                    <p>Покроково оформимо першу покупку на корейській платформі Gmarket та розберемо основні поля під час оформлення замовлення.</p>
                </div>

                <!-- Desktop site frame -->
                <div class="gmarket-desktop-frame" onclick="openVideoModal('Покрокове оформлення покупки на Gmarket')">
                    <img src="img/course/p2/screen_gmarket_site.png" alt="Оформлення замовлення на Gmarket" loading="lazy" />
                </div>
            </section>

            <!-- Footer Package 2 Badge -->
            <div class="footer-pkg2-wrap">
                <img src="img/course/p2/footer_pkg2_badge.png" alt="Пакет 2. Стандарт: Китай та Корея" />
            </div>

        </main>
    </div>

    <!-- ==========================================================================
         MODAL: SAVED FAVORITES (FROM PAKET 1)
         ========================================================================== -->
    <div class="modal-backdrop" id="savedModal" onclick="closeSavedModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close-btn" onclick="closeSavedModal()">✕</button>
            <h3 class="modal-title">Збережені сайти</h3>
            <div class="saved-list-items" id="savedItemsContainer">
                <div style="color: #666; font-size: 14px; text-align: center; padding: 30px 0;">У вас поки немає збережених сайтів. Натискайте на іконку закладки на картках!</div>
            </div>
        </div>
    </div>

    <!-- ==========================================================================
         MODAL: VIDEO PLAYER (FROM PAKET 1)
         ========================================================================== -->
    <div class="modal-backdrop" id="videoModal" onclick="closeVideoModal(event)">
        <div class="modal-content" style="max-width: 480px; text-align: center;" onclick="event.stopPropagation()">
            <button class="modal-close-btn" onclick="closeVideoModal()">✕</button>
            <h3 class="modal-title" id="videoModalTitle">Відеоінструкція</h3>
            <div style="position: relative; border-radius: 20px; overflow: hidden; background: #000; padding: 40px 20px; color: #fff; margin-top: 10px;">
                <div style="font-size: 48px; margin-bottom: 12px;">▶</div>
                <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Відео відтворюється в кабінеті</div>
                <div style="font-size: 13px; opacity: 0.8;">Усі навчальні відеоматеріали доступні для перегляду онлайн без обмежень за часом.</div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="copyToast" style="display: none; position: fixed; bottom: 30px; right: 30px; background: #1627EC; color: #FFFFFF; padding: 14px 24px; border-radius: 12px; font-weight: 600; font-size: 14px; box-shadow: 0 8px 24px rgba(22,39,236,0.3); z-index: 10000; transition: opacity 0.3s ease;">
        Текст листа успішно скопійовано!
    </div>

    <!-- SCRIPT LOGIC -->
    <script>
        // ----------------------------------------------------
        // BOOKMARKS / FAVORITES SYSTEM (MATCHING PAKET-1)
        // ----------------------------------------------------
        var savedBookmarks = JSON.parse(localStorage.getItem('ustunel_saved_cards_p2') || '[]');

        function updateBookmarkUI() {
            var count = savedBookmarks.length;
            var countEl = document.getElementById('savedCount');
            var countMobEl = document.getElementById('savedCountMobile');
            if (countEl) countEl.innerText = count;
            if (countMobEl) countMobEl.innerText = count;

            // Update card bookmark buttons
            document.querySelectorAll('.site-card').forEach(function(card) {
                var id = parseInt(card.getAttribute('data-id'), 10);
                var btn = card.querySelector('.card-bookmark-btn');
                if (btn) {
                    if (savedBookmarks.indexOf(id) !== -1) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                }
            });

            // Update saved modal list
            var container = document.getElementById('savedItemsContainer');
            if (!container) return;
            if (savedBookmarks.length === 0) {
                container.innerHTML = '<div style="color: #666; font-size: 14px; text-align: center; padding: 30px 0;">У вас поки немає збережених сайтів. Натискайте на іконку закладки на картках!</div>';
            } else {
                var html = '';
                savedBookmarks.forEach(function(id) {
                    var card = document.getElementById('card-' + id);
                    if (card) {
                        var title = card.getAttribute('data-title') || '';
                        var country = card.getAttribute('data-country') || '';
                        var badge = card.getAttribute('data-badge') || '';
                        var url = card.getAttribute('data-url') || '';

                        html += '<div class="saved-item-row">' +
                                    '<div class="saved-item-info">' +
                                        '<img src="img/course/p2_badges/' + badge + '" class="saved-item-logo" alt="" />' +
                                        '<div>' +
                                            '<div class="saved-item-name">' + title + '</div>' +
                                            '<div class="saved-item-country">' + country + '</div>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div style="display: flex; align-items: center; gap: 10px;">' +
                                        '<a href="' + url + '" target="_blank" rel="noopener noreferrer" class="card-link" style="font-size: 13px;">Перейти ↗</a>' +
                                        '<button onclick="toggleBookmark(' + id + ')" style="background: none; border: none; cursor: pointer; color: #888; font-size: 16px;">✕</button>' +
                                    '</div>' +
                                '</div>';
                    }
                });
                container.innerHTML = html;
            }
        }

        function toggleBookmark(id) {
            var idx = savedBookmarks.indexOf(id);
            if (idx === -1) {
                savedBookmarks.push(id);
            } else {
                savedBookmarks.splice(idx, 1);
            }
            localStorage.setItem('ustunel_saved_cards_p2', JSON.stringify(savedBookmarks));
            updateBookmarkUI();
        }

        // Saved Modal open/close
        function openSavedModal() {
            var m = document.getElementById('savedModal');
            if (m) m.classList.add('open');
        }

        function closeSavedModal(e) {
            var m = document.getElementById('savedModal');
            if (m) m.classList.remove('open');
        }

        // Video Modal Controls
        function openVideoModal(title) {
            var t = document.getElementById('videoModalTitle');
            if (t) t.innerText = title || 'Відеоінструкція';
            var m = document.getElementById('videoModal');
            if (m) m.classList.add('open');
        }

        function closeVideoModal(e) {
            var m = document.getElementById('videoModal');
            if (m) m.classList.remove('open');
        }

        // Copy Email Template
        function copyEmailTemplate(btn) {
            var text = document.getElementById('emailTemplateText').innerText;
            navigator.clipboard.writeText(text).then(function() {
                var origHtml = btn.innerHTML;
                btn.innerHTML = '<span>✓ Скопійовано</span>';
                btn.style.background = '#10B981';
                
                var toast = document.getElementById('copyToast');
                toast.style.display = 'block';
                setTimeout(function() {
                    toast.style.display = 'none';
                    btn.innerHTML = origHtml;
                    btn.style.background = '#1627EC';
                }, 2500);
            });
        }

        // Accordion Toggle
        function toggleAccordion(id) {
            const acc = document.getElementById(id);
            if (acc) {
                acc.classList.toggle('open');
            }
        }

        // Mobile Menu
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const courseSidebar = document.getElementById('courseSidebar');
        if (mobileMenuToggle && courseSidebar) {
            mobileMenuToggle.addEventListener('click', () => {
                courseSidebar.classList.toggle('mobile-open');
            });
        }

        // ----------------------------------------------------
        // SCROLLSPY & SIDEBAR NAVIGATION
        // ----------------------------------------------------
        const navLinks = document.querySelectorAll('.sidebar-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                navLinks.forEach(function(l) { l.classList.remove('active'); });
                this.classList.add('active');
                const sidebar = document.getElementById('courseSidebar');
                if (sidebar) sidebar.classList.remove('mobile-open');
            });
        });

        window.addEventListener('scroll', function() {
            const scrollPos = window.scrollY + 100;
            const sections = document.querySelectorAll('.course-section, .module-header');
            sections.forEach(function(sec) {
                const top = sec.offsetTop;
                const height = sec.offsetHeight;
                const id = sec.getAttribute('id');
                if (id && scrollPos >= top && scrollPos < top + height) {
                    navLinks.forEach(function(link) {
                        if (link.getAttribute('data-target') === id) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        });

        // ----------------------------------------------------
        // ADAPTIVE DOME CARD SHAPE GENERATOR
        // ----------------------------------------------------
        function updateCardShapes() {
            const cards = document.querySelectorAll('.site-card');
            cards.forEach(function(card) {
                const w = card.offsetWidth;
                const h = card.offsetHeight;
                if (!w || !h) return;
                const path = card.querySelector('.card-bg-path');
                if (!path) return;
                const d = 'M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 ' +
                        'L ' + (w - 30.00) + ' 37.00 ' +
                        'C ' + (w - 13.43) + ' 37.00, ' + w + ' 50.43, ' + w + ' 67.00 ' +
                        'L ' + w + ' ' + (h - 30.00) + ' ' +
                        'C ' + w + ' ' + (h - 13.43) + ', ' + (w - 13.43) + ' ' + h + ', ' + (w - 30.00) + ' ' + h + ' ' +
                        'L 30.00 ' + h + ' ' +
                        'C 13.43 ' + h + ', 0.00 ' + (h - 13.43) + ', 0.00 ' + (h - 30.00) + ' ' +
                        'L 0.00 67.00 ' +
                        'C 0.00 50.43, 13.43 37.00, 30.00 37.00 ' +
                        'C 37.71 37.00, 43.77 30.62, 47.02 23.62 ' +
                        'C 53.45 9.76, 68.91 0.00, 86.96 0.00 Z';
                path.setAttribute('d', d);
            });
        }
        window.addEventListener('load', updateCardShapes);
        window.addEventListener('resize', updateCardShapes);
        if ('ResizeObserver' in window) {
            new ResizeObserver(updateCardShapes).observe(document.body);
        }

        // Event Listeners on load
        document.addEventListener('DOMContentLoaded', function() {
            updateBookmarkUI();
            updateCardShapes();

            var savedBtn = document.getElementById('savedItemsBtn');
            var savedBtnMob = document.getElementById('savedItemsBtnMobile');

            if (savedBtn) savedBtn.addEventListener('click', openSavedModal);
            if (savedBtnMob) savedBtnMob.addEventListener('click', openSavedModal);

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSavedModal();
                    closeVideoModal();
                }
            });
        });
    </script>

    <!-- ============================================================
         Account Info Popup
         ============================================================ -->
    <div class="user-popup-overlay" id="userPopupOverlay">
        <div class="user-popup-card" id="userPopupCard">
            <div class="user-popup-header">
                <div class="user-popup-avatar">
                    <img src="img/course/user_avatar.png" alt="<?php echo htmlspecialchars($current_user['name']); ?>">
                </div>
                <div class="user-popup-header-info">
                    <div class="user-popup-label">МІЙ АКАУНТ</div>
                    <div class="user-popup-fullname"><?php echo htmlspecialchars($current_user['name']); ?></div>
                </div>
                <button class="user-popup-close" id="userPopupClose" aria-label="Закрити">&#x2715;</button>
            </div>
            <div class="user-popup-body">
                <div class="user-popup-row">
                    <div class="user-popup-row-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="user-popup-row-content">
                        <div class="user-popup-row-label">Ім'я</div>
                        <div class="user-popup-row-value"><?php echo htmlspecialchars($current_user['name']); ?></div>
                    </div>
                </div>
                <div class="user-popup-row">
                    <div class="user-popup-row-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <div class="user-popup-row-content">
                        <div class="user-popup-row-label">Email</div>
                        <div class="user-popup-row-value"><?php echo htmlspecialchars($current_user['email']); ?></div>
                    </div>
                </div>
                <?php if (!empty($current_user['phone'])): ?>
                <div class="user-popup-row">
                    <div class="user-popup-row-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.61 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </div>
                    <div class="user-popup-row-content">
                        <div class="user-popup-row-label">Телефон</div>
                        <div class="user-popup-row-value"><?php echo htmlspecialchars($current_user['phone']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="user-popup-row">
                    <div class="user-popup-row-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    </div>
                    <div class="user-popup-row-content">
                        <div class="user-popup-row-label">Тариф</div>
                        <div class="user-popup-row-value"><?php
                            $pkgs = get_packages_config();
                            echo htmlspecialchars($pkgs[$current_user['package_level']]['name'] ?? 'Пакет ' . $current_user['package_level']);
                        ?></div>
                    </div>
                </div>
            </div>
            <div class="user-popup-footer">
                <a href="logout.php" class="user-popup-btn-logout">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Вийти з акаунту
                </a>
            </div>
        </div>
    </div>

    <script>
        // Account popup
        (function() {
            var trigger  = document.getElementById('userProfileTrigger');
            var overlay  = document.getElementById('userPopupOverlay');
            var closeBtn = document.getElementById('userPopupClose');

            function openPopup()  { overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
            function closePopup() { overlay.classList.remove('active'); document.body.style.overflow = ''; }

            if (trigger)  trigger.addEventListener('click', openPopup);
            if (closeBtn) closeBtn.addEventListener('click', closePopup);
            if (overlay)  overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closePopup();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && overlay.classList.contains('active')) closePopup();
            });
        })();
    </script>
</body>
</html>
