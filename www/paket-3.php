<?php
// paket-3.php - Course Package 3: VIP (Personal Mentoring)
require_once __DIR__ . '/includes/auth.php';
$current_user = require_package(3);

// Load Turkish brands data from JSON
$cards_file = __DIR__ . '/img/course/cards_data_p3.json';
$all_cards = file_exists($cards_file) ? json_decode(file_get_contents($cards_file), true) : [];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Пакет 3. VIP: Особистий супровід та Турецькі сайти | Офіційний курс</title>
    <meta name="description" content="Пакет 3. VIP: Особистий супровід від Марини Устунель, чат підтримки, повна добірка турецьких сайтів і брендів." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="css/main.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-1.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-2.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/paket-3.css?v=<?php echo rand(1, 99999); ?>" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="course-body">

    <!-- Mobile Top Header Bar -->
    <div class="mobile-header-bar">
        <button class="mobile-menu-btn" id="mobileMenuToggle">☰ Модулі курсу</button>
        <div style="font-weight: 700; font-size: 13px; color: #F15A24;">ПАКЕТ 3: VIP СУПРОВІД</div>
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

                <!-- Link to Package 2 -->
                <div class="sidebar-pkg-title" style="margin-top: 14px; border-top: 1px solid #C4B1A0; padding-top: 14px;">
                    <a href="paket-2.php" style="color: inherit; text-decoration: none; display: flex; align-items: center; justify-content: space-between;">
                        <span>ПАКЕТ 2. СТАНДАРТ:<br/>КИТАЙ ТА КОРЕЯ</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>

                <!-- Package 3 Title (Active) -->
                <div class="sidebar-pkg-title sidebar-pkg-active-vip" style="margin-top: 14px; border-top: 1px solid #C4B1A0; padding-top: 14px;">
                    ПАКЕТ 3. VIP:<br/>ОСОБИСТИЙ СУПРОВІД
                </div>

                <!-- Navigation Accordion for Package 3 -->
                <nav class="sidebar-nav">
                    <!-- Module 7 -->
                    <div class="sidebar-mod open" id="mod7Accordion">
                        <button class="sidebar-mod-btn active-orange" onclick="toggleAccordion('mod7Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m1.png" class="mod-icon" alt="" />
                                <span>МОДУЛЬ 7.<br/>Зв'язок зі мною</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#p3_mod7_sec_01" class="sidebar-link active" data-target="p3_mod7_sec_01">01 Знайомство та чат</a>
                        </div>
                    </div>

                    <!-- Module 8 -->
                    <div class="sidebar-mod open" id="mod8Accordion">
                        <button class="sidebar-mod-btn mod-tan" onclick="toggleAccordion('mod8Accordion')">
                            <span class="mod-btn-left">
                                <img src="img/course/icon_m2.png" class="mod-icon" alt="" />
                                <span>МОДУЛЬ 8.<br/>Турецькі сайти</span>
                            </span>
                            <svg class="mod-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="sidebar-subitems">
                            <a href="#p3_mod8_sec_01" class="sidebar-link" data-target="p3_mod8_sec_01">01 Турецькі сайти</a>
                        </div>
                    </div>
                </nav>
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
                    <span>Вийти з кабінету</span>
                </a>
            </div>

            <!-- ==========================================================================
                 MODULE 7: ЗВ'ЯЗОК ЗІ МНОЮ
                 ========================================================================== -->
            <div class="module-header" id="p3_mod7_sec_01">
                <div class="module-oval-container">
                    <h1 class="module-title">МОДУЛЬ 7. ЗВ'ЯЗОК ЗІ МНОЮ</h1>
                </div>
                <div class="module-subtitle">
                    У цьому пакеті ви отримуєте не лише доступ до всіх матеріалів курсу, а й можливість особисто звернутися до мене за допомогою. Якщо виникнуть питання під час реєстрації, вибору платформи чи оформлення першого замовлення — пишіть мені в особистий чат.
                </div>
            </div>

            <section class="course-section">
                <div class="module7-stage">
                    <!-- Left: Note + Polaroid + Telegram button -->
                    <div class="module7-col-left">
                        <div class="module7-note-wrap">
                            <img src="img/course/p3_note_card.png" alt="Записка Марини Устунель: Я поруч, щоб допомогти" class="module7-note-img" />
                        </div>
                        <div class="module7-polaroid-wrap">
                            <img src="img/course/p3_polaroid.png" alt="Марина Устунель" class="module7-polaroid-img" />
                        </div>
                        <a href="https://t.me/+DJ8At29MEy0xMzMy" target="_blank" rel="noopener noreferrer" class="module7-telegram-btn">
                            [ написати в телеграм <span class="telegram-arrow">↗</span> ]
                        </a>
                    </div>

                    <!-- Right: iPhone Mockup with Video Preview -->
                    <div class="module7-col-right">
                        <div class="module7-phone-wrap" onclick="openVideoModal('Знайомство та супровід від Марини Устунель')" title="Натисніть для перегляду відеознайомства">
                            <img src="img/course/p3_phone_mockup.png" alt="Відеознайомство: Марина Устунель" class="module7-phone-img" />
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==========================================================================
                 MODULE 8: ТУРЕЦЬКІ САЙТИ
                 ========================================================================== -->
            <div class="module-header" id="p3_mod8_sec_01" style="margin-top: 80px;">
                <div class="module-oval-container">
                    <h2 class="module-title">МОДУЛЬ 8. ТУРЕЦЬКІ САЙТИ</h2>
                </div>
                <div class="module-subtitle">
                    Добірка турецьких брендів, на які варто звернути увагу: від преміальної класики та якісного базового гардероба до деніму, взуття й актуальних трендових моделей.
                </div>
            </div>

            <!-- SECTION 01: Турецькі бренди -->
            <section class="course-section">
                <h2 class="section-heading">Турецькі бренди, які варто знати</h2>
                <div class="turkish-intro-text">
                    <p>Розберемо турецькі бренди за напрямками та ціновими сегментами, щоб вам було простіше орієнтуватися серед локальних марок і знаходити якісні варіанти для покупок. Також можна сайти використовувати VPN Туреччина.</p>
                </div>

                <div class="cards-grid">
                    <?php foreach ($all_cards as $card): ?>
                        <div class="site-card" id="card-<?php echo $card['id']; ?>" data-id="<?php echo $card['id']; ?>" data-title="<?php echo htmlspecialchars($card['title']); ?>" data-country="<?php echo htmlspecialchars($card['country']); ?>" data-badge="<?php echo htmlspecialchars($card['badge']); ?>" data-url="<?php echo htmlspecialchars($card['url']); ?>">
                            <!-- SVG Card Shape Background with Architectural Dome -->
                            <svg class="card-bg-svg" viewBox="0 0 369 259" fill="none" preserveAspectRatio="none">
                                <path class="card-bg-path" d="M 86.96 0.00 C 98.31 0.00, 108.64 3.86, 116.34 10.18 C 129.72 21.15, 143.84 37.00, 161.16 37.00 L 339.00 37.00 C 355.57 37.00, 369.00 50.43, 369.00 67.00 L 369.00 229.00 C 369.00 245.57, 355.57 259.00, 339.00 259.00 L 30.00 259.00 C 13.43 259.00, 0.00 245.57, 0.00 229.00 L 0.00 67.00 C 0.00 50.43, 13.43 37.00, 30.00 37.00 C 37.71 37.00, 43.77 30.62, 47.02 23.62 C 53.45 9.76, 68.91 0.00, 86.96 0.00 Z" fill="#DDD9E3" stroke="#BDB8C7" stroke-width="1.5"/>
                            </svg>

                            <!-- Circular Logo Badge centered inside Dome -->
                            <div class="card-badge-wrap">
                                <img src="img/course/p3_badges/<?php echo htmlspecialchars($card['badge']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>" class="card-badge-img" loading="lazy" />
                            </div>

                            <!-- Top-Right Actions (Multiple Pills & Bookmark) -->
                            <div class="card-header-actions">
                                <div class="card-tags-group">
                                    <?php 
                                    $tags = $card['tags'] ?? [$card['tag'] ?? ''];
                                    foreach ($tags as $t): 
                                        if (!empty($t)):
                                    ?>
                                        <span class="card-tag"><?php echo htmlspecialchars($t); ?></span>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
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
                                    <span class="card-link-text"><?php echo htmlspecialchars($card['url_text'] ?? $card['url']); ?></span>
                                    <svg viewBox="0 0 24 24" class="card-link-arrow-svg"><path d="M7 17L17 7M17 7H9M17 7V15"></path></svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <h3 class="modal-title" id="videoModalTitle">Відеознайомство</h3>
            <div style="position: relative; border-radius: 20px; overflow: hidden; background: #000; padding: 40px 20px; color: #fff; margin-top: 10px;">
                <div style="font-size: 48px; margin-bottom: 12px;">▶</div>
                <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Відео відтворюється в кабінеті</div>
                <div style="font-size: 13px; opacity: 0.8;">Усі навчальні відеоматеріали та персональний супровід доступні онлайн без обмежень за часом.</div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script type="text/javascript">
        // ----------------------------------------------------
        // BOOKMARKS / FAVORITES SYSTEM
        // ----------------------------------------------------
        var savedBookmarks = JSON.parse(localStorage.getItem('saved_course_sites') || '[301]');

        function updateBookmarkUI() {
            var count = savedBookmarks.length;
            var savedCount = document.getElementById('savedCount');
            if (savedCount) savedCount.innerText = count;
            var mobileCount = document.getElementById('savedCountMobile');
            if (mobileCount) mobileCount.innerText = count;

            document.querySelectorAll('.site-card').forEach(function(card) {
                var id = parseInt(card.getAttribute('data-id'));
                var btn = card.querySelector('.card-bookmark-btn');
                if (btn) {
                    if (savedBookmarks.indexOf(id) !== -1) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                }
            });

            var container = document.getElementById('savedItemsContainer');
            if (!container) return;
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
                                        '<img src="img/course/p3_badges/' + badge + '" class="saved-item-logo" alt="" />' +
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
                container.innerHTML = html || '<div style="color: #666; font-size: 14px; text-align: center; padding: 30px 0;">Збережені елементи з інших модулів курсу.</div>';
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

        function openSavedModal() {
            updateBookmarkUI();
            var m = document.getElementById('savedModal');
            if (m) m.classList.add('open');
        }
        function closeSavedModal(event) {
            if (!event || event.target.id === 'savedModal' || event.target.classList.contains('modal-close-btn')) {
                var m = document.getElementById('savedModal');
                if (m) m.classList.remove('open');
            }
        }

        function openVideoModal(title) {
            var t = document.getElementById('videoModalTitle');
            if (t) t.innerText = title;
            var v = document.getElementById('videoModal');
            if (v) v.classList.add('open');
        }
        function closeVideoModal(event) {
            if (!event || event.target.id === 'videoModal' || event.target.classList.contains('modal-close-btn')) {
                var v = document.getElementById('videoModal');
                if (v) v.classList.remove('open');
            }
        }

        function toggleAccordion(modId) {
            var mod = document.getElementById(modId);
            if (mod) {
                mod.classList.toggle('open');
            }
        }

        // Mobile Menu Toggle
        var menuBtn = document.getElementById('mobileMenuToggle');
        var sidebar = document.getElementById('courseSidebar');
        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('mobile-active');
            });
            document.addEventListener('click', function(e) {
                if (sidebar.classList.contains('mobile-active') && !sidebar.contains(e.target) && e.target !== menuBtn) {
                    sidebar.classList.remove('mobile-active');
                }
            });
        }

        // Smooth Scroll & Active Nav Spy
        document.querySelectorAll('.sidebar-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var targetId = this.getAttribute('data-target');
                var targetEl = document.getElementById(targetId);
                if (targetEl) {
                    e.preventDefault();
                    if (sidebar) sidebar.classList.remove('mobile-active');
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    document.querySelectorAll('.sidebar-link').forEach(function(l) { l.classList.remove('active'); });
                    this.classList.add('active');
                }
            });
        });

        // Dynamic SVG Path recalculation for responsive Card Dome
        function updateCardShapes() {
            var cards = document.querySelectorAll('.site-card');
            cards.forEach(function(card) {
                var svg = card.querySelector('.card-bg-svg');
                var path = card.querySelector('.card-bg-path');
                if (!svg || !path) return;

                var w = card.offsetWidth;
                var h = card.offsetHeight;
                if (w === 0 || h === 0) return;

                svg.setAttribute('viewBox', '0 0 ' + w + ' ' + h);

                var r = 30; // corner radius
                var domeR = 54; // dome cutout radius
                var domeCenterX = 87; // center of dome circle
                var shoulderY = 37; // right side flat top height

                var d = 'M ' + domeCenterX + ' 0.00 ' +
                        'C ' + (domeCenterX + 11.35) + ' 0.00, ' + (domeCenterX + 21.68) + ' 3.86, ' + (domeCenterX + 29.38) + ' 10.18 ' +
                        'C ' + (domeCenterX + 42.76) + ' 21.15, ' + (domeCenterX + 56.88) + ' ' + shoulderY + ', ' + (domeCenterX + 74.20) + ' ' + shoulderY + ' ' +
                        'L ' + (w - r) + ' ' + shoulderY + ' ' +
                        'C ' + (w - r * 0.45) + ' ' + shoulderY + ', ' + w + ' ' + (shoulderY + r * 0.45) + ', ' + w + ' ' + (shoulderY + r) + ' ' +
                        'L ' + w + ' ' + (h - r) + ' ' +
                        'C ' + w + ' ' + (h - r * 0.45) + ', ' + (w - r * 0.45) + ' ' + h + ', ' + (w - r) + ' ' + h + ' ' +
                        'L ' + r + ' ' + h + ' ' +
                        'C ' + (r * 0.45) + ' ' + h + ', 0.00 ' + (h - r * 0.45) + ', 0.00 ' + (h - r) + ' ' +
                        'L 0.00 ' + (shoulderY + r) + ' ' +
                        'C 0.00 ' + (shoulderY + r * 0.45) + ', ' + (r * 0.45) + ' ' + shoulderY + ', ' + r + ' ' + shoulderY + ' ' +
                        'C ' + (r + 7.71) + ' ' + shoulderY + ', ' + (r + 13.77) + ' 30.62, ' + (r + 17.02) + ' 23.62 ' +
                        'C ' + (r + 23.45) + ' 9.76, ' + (domeCenterX - 18.05) + ' 0.00, ' + domeCenterX + ' 0.00 Z';
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
