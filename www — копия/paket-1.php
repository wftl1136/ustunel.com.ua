<?php
require_once __DIR__ . '/includes/auth.php';
$current_user = require_package(1);

// Load cards data from JSON
$cards_file = __DIR__ . '/img/course/cards_data.json';
$all_cards = file_exists($cards_file) ? json_decode(file_get_contents($cards_file), true) : [];

// Group cards by section
$sections = [
    'sec_01' => [
        'title' => '01 Для старту - ТОП 7 сайтів',
        'cards' => []
    ],
    'sec_02' => [
        'title' => '02 Мікс-аутлети',
        'cards' => []
    ],
    'sec_03' => [
        'title' => '03 Універсальні покупки',
        'cards' => []
    ],
    'sec_04' => [
        'title' => '04 Дитячі товари',
        'cards' => []
    ],
    'sec_05' => [
        'title' => '05 Косметика та парфумерія',
        'cards' => []
    ],
    'sec_06' => [
        'title' => '06 Взуття',
        'cards' => []
    ],
    'sec_07' => [
        'title' => '07 Одяг та аксесуари',
        'cards' => []
    ]
];

foreach ($all_cards as $c) {
    $sec = $c['sec'] ?? 'sec_01';
    if (isset($sections[$sec])) {
        $sections[$sec]['cards'][] = $c;
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Пакет 1. Базовий: ЄВРОПА ТА АМЕРИКА | Офіційний курс</title>
    <meta name="description" content="Пакет 1. Базовий: Сайти Європи та Америки для вигідних покупок одягу, взуття, косметики та брендів без переплат." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="css/main.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-1.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="course-body">

    <!-- Mobile Top Header Bar -->
    <div class="mobile-header-bar">
        <button class="mobile-menu-btn" id="mobileMenuToggle">☰ Модулі курсу</button>
        <div style="font-weight: 700; font-size: 13px; color: #1627EC;">ПАКЕТ 1: ЄВРОПА ТА АМЕРИКА</div>
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

                <div class="sidebar-pkg-title">
                    Пакет 1. Базовий: ЄВРОПА ТА АМЕРИКА
                </div>

                <!-- Navigation Accordion -->
                <nav class="sidebar-nav">
                    <!-- Module 1 -->
                    <div class="sidebar-mod open" id="mod1Accordion">
                        <button class="sidebar-mod-btn active-orange" onclick="toggleAccordion('mod1Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m1.png" class="mod-icon" alt="" />
                                <span>Модуль 1. Сайти<br/>Європи та Америки</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#sec_01" class="sidebar-link active" data-target="sec_01">01 Для старту</a>
                            <a href="#sec_02" class="sidebar-link" data-target="sec_02">02 Мікс-аутлети</a>
                            <a href="#sec_03" class="sidebar-link" data-target="sec_03">03 Універсальні покупки</a>
                            <a href="#sec_04" class="sidebar-link" data-target="sec_04">04 Дитячі товари</a>
                            <a href="#sec_05" class="sidebar-link" data-target="sec_05">05 Косметика та парфумерія</a>
                            <a href="#sec_06" class="sidebar-link" data-target="sec_06">06 Взуття</a>
                            <a href="#sec_07" class="sidebar-link" data-target="sec_07">07 Одяг та аксесуари</a>
                        </div>
                    </div>

                    <!-- Module 2 -->
                    <div class="sidebar-mod" id="mod2Accordion">
                        <button class="sidebar-mod-btn mod-tan" onclick="toggleAccordion('mod2Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m2.png" class="mod-icon" alt="" />
                                <span>Модуль 2.<br/>Логістична компанія</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#mod2_sec_01" class="sidebar-link" data-target="mod2_sec_01">01 Реєстрація</a>
                            <a href="#mod2_sec_02" class="sidebar-link" data-target="mod2_sec_02">02 Як користуватися сервісом</a>
                            <a href="#mod2_sec_03" class="sidebar-link" data-target="mod2_sec_03">03 Як зробити перше замовлення</a>
                        </div>
                    </div>

                    <!-- Module 3 -->
                    <div class="sidebar-mod" id="mod3Accordion">
                        <button class="sidebar-mod-btn mod-tan" onclick="toggleAccordion('mod3Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m3.png" class="mod-icon" alt="" />
                                <span>Модуль 3.<br/>Митниця та податки</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#mod3_sec_01" class="sidebar-link" data-target="mod3_sec_01">01 Митні правила</a>
                            <a href="#mod3_sec_02" class="sidebar-link" data-target="mod3_sec_02">02 Митні платежі</a>
                            <a href="#mod3_sec_03" class="sidebar-link" data-target="mod3_sec_03">03 Як уникнути переплати</a>
                        </div>
                    </div>
                </nav>

                <!-- Bottom Upsells -->
                <div class="sidebar-upsell-list">
                    <?php if ((int)$current_user['package_level'] >= 2): ?>
                        <div class="sidebar-upsell-card" style="background: rgba(22, 39, 236, 0.08); border-color: #1627EC;">
                            <div class="upsell-left">
                                <span style="color: #10B981; font-size: 16px; font-weight: 700;">✓</span>
                                <span class="upsell-title" style="color: #1627EC;">ПАКЕТ 2. СТАНДАРТ:<br/>КИТАЙ ТА КОРЕЯ</span>
                            </div>
                            <a href="paket-2.php" class="upsell-buy-btn" style="background: #1627EC;">ВХІД →</a>
                        </div>
                    <?php else: ?>
                        <div class="sidebar-upsell-card">
                            <div class="upsell-left">
                                <img src="img/course/icon_lock.png" class="upsell-lock-icon" alt="Lock" />
                                <span class="upsell-title">ПАКЕТ 2. СТАНДАРТ:<br/>КИТАЙ ТА КОРЕЯ</span>
                            </div>
                            <a href="index.php#tariffs" class="upsell-buy-btn">BUY ↗</a>
                        </div>
                    <?php endif; ?>
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

            <!-- MODULE 1 BANNER -->
            <div class="module-header" id="module_1">
                <div class="module-oval-container">
                    <h1 class="module-title">МОДУЛЬ 1. САЙТИ ЄВРОПИ ТА АМЕРИКИ</h1>
                </div>
                <div class="module-subtitle">
                    У цьому модулі зібрані перевірені сайти Європи та Америки для вигідних покупок.<br/>
                    Для зручності всі платформи розподілені за категоріями.
                </div>
            </div>

            <!-- SECTIONS 01 TO 07 -->
            <?php foreach ($sections as $sec_id => $sec_data): ?>
                <section class="course-section" id="<?php echo $sec_id; ?>">
                    <h2 class="section-heading"><?php echo htmlspecialchars($sec_data['title']); ?></h2>

                    <div class="cards-grid">
                        <?php foreach ($sec_data['cards'] as $card): ?>
                            <div class="site-card" id="card-<?php echo $card['id']; ?>" data-id="<?php echo $card['id']; ?>" data-title="<?php echo htmlspecialchars($card['title']); ?>" data-country="<?php echo htmlspecialchars($card['country']); ?>" data-badge="<?php echo htmlspecialchars($card['badge']); ?>" data-url="<?php echo htmlspecialchars($card['url']); ?>">
                                <!-- SVG Card Shape Background with Architectural Dome -->
                                <svg class="card-bg-svg" viewBox="0 0 369 259" fill="none" preserveAspectRatio="none">
                                    <path class="card-bg-path" d="M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 L 339.00 37.00 C 355.57 37.00, 369.00 50.43, 369.00 67.00 L 369.00 229.00 C 369.00 245.57, 355.57 259.00, 339.00 259.00 L 30.00 259.00 C 13.43 259.00, 0.00 245.57, 0.00 229.00 L 0.00 67.00 C 0.00 50.43, 13.43 37.00, 30.00 37.00 C 37.71 37.00, 43.77 30.62, 47.02 23.62 C 53.45 9.76, 68.91 0.00, 86.96 0.00 Z" fill="#DDD9E3" stroke="#BDB8C7" stroke-width="1.5"/>
                                </svg>

                                <!-- Circular Logo Badge centered inside Dome -->
                                <div class="card-badge-wrap">
                                    <img src="img/course/badges/<?php echo htmlspecialchars($card['badge']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>" class="card-badge-img" loading="lazy" />
                                </div>

                                <!-- Top-Right Actions (Pill & Bookmark) -->
                                <div class="card-header-actions">
                                    <span class="card-tag"><?php echo htmlspecialchars($card['tag']); ?></span>
                                    <button class="card-bookmark-btn<?php echo ($card['id'] === 1) ? ' active' : ''; ?>" onclick="toggleBookmark(<?php echo $card['id']; ?>)" title="Додати до збережених" aria-label="Зберегти">
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

                        <?php if ($sec_id === 'sec_01'): ?>
                            <!-- Decorative Crown from original Figma design -->
                            <div class="crown-decoration">
                                <img src="img/course/crown_illustration.png" alt="" />
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endforeach; ?>

            <!-- ==========================================================================
                 MODULE 2: ЛОГІСТИЧНА КОМПАНІЯ
                 ========================================================================== -->
            <div class="module-header" id="mod2_sec_01" style="margin-top: 80px;">
                <div class="module-oval-container">
                    <h2 class="module-title">МОДУЛЬ 2. ЛОГІСТИЧНА КОМПАНІЯ</h2>
                </div>
                <div class="module-subtitle">
                    У цьому модулі ви дізнаєтесь, як користуватися логістичною компанією для доставки покупок з іноземних сайтів в Україну: від реєстрації та отримання адреси складу до оформлення й відстеження першого замовлення.
                </div>
                <div class="flow-steps">
                    <span>Обрали товар</span>
                    <span class="flow-step-arrow">→</span>
                    <span>Оформили доставку на склад</span>
                    <span class="flow-step-arrow">→</span>
                    <span>Зареєстрували покупку</span>
                    <span class="flow-step-arrow">→</span>
                    <span>Отримали в Україні</span>
                </div>
            </div>

            <!-- Sub 01: Реєстрація -->
            <section class="course-section">
                <h3 class="section-heading">01 РЕЄСТРАЦІЯ</h3>
                <div class="meest-section-content">
                    <div class="phone-mockup-wrapper" onclick="openVideoModal('Відеоінструкція: Реєстрація в логістичній компанії')">
                        <img src="img/course/meest_phone_registration.png" alt="Реєстрація Meest" />
                    </div>
                </div>
            </section>

            <!-- Sub 02: Як користуватися сервісом -->
            <section class="course-section" id="mod2_sec_02">
                <h3 class="section-heading">02 ЯК КОРИСТУВАТИСЯ СЕРВІСОМ</h3>
                <div style="font-size: 16px; font-weight: 700; color: #1627EC; margin-bottom: 6px;" id="sliderStepTitle">
                    1. Відкрийте додаток
                </div>
                <div style="font-size: 14px; color: #1627EC; margin-bottom: 20px;" id="sliderStepDesc">
                    Відкрийте Meest Shopping та натисніть «Зареєструвати посилку»
                </div>

                <div class="meest-section-content">
                    <div class="meest-slider-box">
                        <button class="slider-arrow-btn" onclick="prevSliderStep()" aria-label="Попередній крок">❮</button>
                        <div class="slider-screen-wrap">
                            <img src="img/course/meest_app_mockup.png" id="meestScreenImg" alt="Meest App Screen" />
                        </div>
                        <button class="slider-arrow-btn" onclick="nextSliderStep()" aria-label="Наступний крок">❯</button>
                    </div>
                </div>
            </section>

            <!-- Sub 03: Перше замовлення -->
            <section class="course-section" id="mod2_sec_03">
                <h3 class="section-heading">03 ЯК ЗРОБИТИ ПЕРШЕ ЗАМОВЛЕННЯ</h3>
                <div style="max-width: 800px; background: #DDD9E3; border-radius: 24px; padding: 24px 30px; line-height: 1.6; font-size: 14px; color: #222;">
                    <p style="margin-top: 0;"><strong>Покроковий чек-лист першого замовлення:</strong></p>
                    <ol style="padding-left: 20px; margin-bottom: 0;">
                        <li>Оберіть потрібний сайт із Модуля 1 та зареєструйтесь на ньому.</li>
                        <li>Вкажіть отриману в Meest Shopping адресу складу в країні магазину як Shipping Address.</li>
                        <li>Вкажіть свою українську картку для оплати (Visa / Mastercard).</li>
                        <li>Отримайте трек-номер від магазину та внесіть його в кабінет Meest Shopping.</li>
                    </ol>
                </div>
            </section>

            <!-- ==========================================================================
                 MODULE 3: МИТНИЦЯ ТА ПОДАТКИ
                 ========================================================================== -->
            <div class="module-header" id="mod3_sec_01" style="margin-top: 80px;">
                <div class="module-oval-container">
                    <h2 class="module-title">МОДУЛЬ 3. МИТНИЦЯ ТА ПОДАТКИ</h2>
                </div>
                <div class="module-subtitle">
                    У цьому модулі розберемо основні правила митного оформлення міжнародних посилок: коли можуть нараховуватися митні платежі, від чого залежить їхня сума та які документи можуть знадобитися для оформлення замовлення.
                </div>
            </div>

            <!-- Marina Video -->
            <section class="course-section">
                <div class="marina-video-block">
                    <div class="marina-phone-wrap" onclick="openVideoModal('Відеорозбір: Правила митниці та податки')">
                        <img src="img/course/marina_phone_mockup.png" alt="Відео Марина: Правила митниці" />
                    </div>
                </div>

                <!-- Subsections 02 & 03 Info -->
                <div id="mod3_sec_02" style="margin-top: 40px;">
                    <h3 class="section-heading">02 МИТНІ ПЛАТЕЖІ ТА 03 ЯК УНИКНУТИ ПЕРЕПЛАТИ</h3>
                    <div style="max-width: 860px; margin: 0 auto; background: #DDD9E3; border-radius: 24px; padding: 24px 32px; font-size: 14.5px; line-height: 1.6; color: #222;">
                        <p><strong>Головні правила безмитних лімітів в Україні:</strong></p>
                        <ul style="padding-left: 20px; list-style-type: disc;">
                            <li>Посилки вартістю до <strong>150 євро</strong> на одного одержувача не обкладаються митом та ПДВ.</li>
                            <li>Якщо сума замовлення перевищує 150 євро — податки нараховуються <em>тільки на суму перевищення</em> (10% мито + 20% ПДВ).</li>
                            <li>Лайфхак: діліть великі замовлення на декілька посилок або замовляйте на різних членів родини, щоб не переплачувати.</li>
                        </ul>
                    </div>
                </div>

                <!-- Warning Box -->
                <div class="vpn-warning-box">
                    <p>❗ Європейські сайти інколи потрібно відкривати за допомогою VPN. Бажано обирати країну, якій відповідає версія сайту, особливо якщо сторінка не відкривається.</p>
                    <p>На більшості сайтів можна оплачувати покупки картками Visa та Mastercard, а інколи також через PayPal. Зазвичай звичайної банківської картки достатньо. ❗</p>
                </div>

                <!-- Upsell Folder Banner -->
                <div class="upsell-footer-banner">
                    <div class="upsell-folder-wrap" onclick="window.location.href='index.php#tariffs'">
                        <img src="img/course/upsell_folder_tickets.png" alt="Пакет 2: Китай та Корея" />
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- ==========================================================================
         MODAL: SAVED FAVORITES
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
         MODAL: VIDEO PLAYER
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

    <!-- Scripts -->
    <script type="text/javascript">
        // ----------------------------------------------------
        // BOOKMARKS / FAVORITES SYSTEM
        // ----------------------------------------------------
        var savedBookmarks = JSON.parse(localStorage.getItem('saved_course_sites') || '[1]');

        function updateBookmarkUI() {
            // Update counter badges
            var count = savedBookmarks.length;
            document.getElementById('savedCount').innerText = count;
            var mobileCount = document.getElementById('savedCountMobile');
            if (mobileCount) mobileCount.innerText = count;

            // Update card bookmark buttons
            document.querySelectorAll('.site-card').forEach(function(card) {
                var id = parseInt(card.getAttribute('data-id'));
                var btn = card.querySelector('.card-bookmark-btn');
                if (savedBookmarks.indexOf(id) !== -1) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            // Update saved modal list
            var container = document.getElementById('savedItemsContainer');
            if (savedBookmarks.length === 0) {
                container.innerHTML = '<div style="color: #666; font-size: 14px; text-align: center; padding: 30px 0;">У вас поки немає збережених сайтів. Натискайте на іконку закладки на картках!</div>';
            } else {
                var html = '';
                savedBookmarks.forEach(function(id) {
                    var card = document.getElementById('card-' + id);
                    if (card) {
                        var title = card.getAttribute('data-title');
                        var country = card.getAttribute('data-country');
                        var badge = card.getAttribute('data-badge');
                        var url = card.getAttribute('data-url');

                        html += '<div class="saved-item-row">' +
                                    '<div class="saved-item-info">' +
                                        '<img src="img/course/badges/' + badge + '" class="saved-item-logo" alt="" />' +
                                        '<div>' +
                                            '<div class="saved-item-name">' + title + '</div>' +
                                            '<div class="saved-item-country">' + country + '</div>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div style="display: flex; align-items: center; gap: 10px;">' +
                                        '<a href="' + url + '" target="_blank" class="card-link" style="font-size: 13px;">Перейти ↗</a>' +
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
            localStorage.setItem('saved_course_sites', JSON.stringify(savedBookmarks));
            updateBookmarkUI();
        }

        // Saved Modal open/close
        document.getElementById('savedItemsBtn').addEventListener('click', function() {
            document.getElementById('savedModal').classList.add('open');
        });
        var mobileSavedBtn = document.getElementById('savedItemsBtnMobile');
        if (mobileSavedBtn) {
            mobileSavedBtn.addEventListener('click', function() {
                document.getElementById('savedModal').classList.add('open');
            });
        }
        function closeSavedModal(e) {
            document.getElementById('savedModal').classList.remove('open');
        }

        // Video Modal open/close
        function openVideoModal(title) {
            document.getElementById('videoModalTitle').innerText = title;
            document.getElementById('videoModal').classList.add('open');
        }
        function closeVideoModal() {
            document.getElementById('videoModal').classList.remove('open');
        }

        // ----------------------------------------------------
        // ACCORDION TOGGLE
        // ----------------------------------------------------
        function toggleAccordion(modId) {
            var mod = document.getElementById(modId);
            if (mod) {
                mod.classList.toggle('open');
            }
        }

        // ----------------------------------------------------
        // MEEST APP SLIDER
        // ----------------------------------------------------
        var sliderSteps = [
            {
                title: '1. Відкрийте додаток',
                desc: 'Відкрийте Meest Shopping та натисніть «Зареєструвати посилку»'
            },
            {
                title: '2. Введіть трек-номер',
                desc: 'Вкажіть трек-номер, наданий інтернет-магазином після відправки замовлення.'
            },
            {
                title: '3. Опишіть товари',
                desc: 'Вкажіть назву товару, кількість та вартість для митного контролю.'
            },
            {
                title: '4. Отримайте доставку в Україні',
                desc: 'Виберіть відділення або кур’єрську доставку до дверей.'
            }
        ];
        var currentStep = 0;

        function updateSlider() {
            var s = sliderSteps[currentStep];
            document.getElementById('sliderStepTitle').innerText = s.title;
            document.getElementById('sliderStepDesc').innerText = s.desc;
        }

        function nextSliderStep() {
            currentStep = (currentStep + 1) % sliderSteps.length;
            updateSlider();
        }

        function prevSliderStep() {
            currentStep = (currentStep - 1 + sliderSteps.length) % sliderSteps.length;
            updateSlider();
        }

        // ----------------------------------------------------
        // SCROLLSPY & SIDEBAR NAVIGATION
        // ----------------------------------------------------
        var navLinks = document.querySelectorAll('.sidebar-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                navLinks.forEach(function(l) { l.classList.remove('active'); });
                this.classList.add('active');
                // Close mobile menu on click
                var sidebar = document.getElementById('courseSidebar');
                if (sidebar) sidebar.classList.remove('mobile-open');
            });
        });

        window.addEventListener('scroll', function() {
            var scrollPos = window.scrollY + 100;
            var sections = document.querySelectorAll('.course-section, .module-header');
            sections.forEach(function(sec) {
                var top = sec.offsetTop;
                var height = sec.offsetHeight;
                var id = sec.getAttribute('id');
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

        // Mobile drawer toggle
        var mobileToggle = document.getElementById('mobileMenuToggle');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                var sidebar = document.getElementById('courseSidebar');
                if (sidebar) sidebar.classList.toggle('mobile-open');
            });
        }

        // ----------------------------------------------------
        // ADAPTIVE DOME CARD SHAPE GENERATOR
        // ----------------------------------------------------
        function updateCardShapes() {
            var cards = document.querySelectorAll('.site-card');
            cards.forEach(function(card) {
                var w = card.offsetWidth;
                var h = card.offsetHeight;
                if (!w || !h) return;
                var path = card.querySelector('.card-bg-path');
                if (!path) return;
                var d = 'M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 ' +
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

        // Initial UI load
        updateBookmarkUI();
        updateCardShapes();
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
            var card     = document.getElementById('userPopupCard');

            function openPopup()  { overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
            function closePopup() { overlay.classList.remove('active'); document.body.style.overflow = ''; }

            if (trigger)  trigger.addEventListener('click', openPopup);
            if (closeBtn) closeBtn.addEventListener('click', closePopup);
            if (overlay)  overlay.addEventListener('click', function(e) {
                if (e.target === overlay) closePopup();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closePopup();
            });
        })();
    </script>
</body>
</html>
