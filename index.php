<?php
require_once 'php/config.php';

$isLoggedIn = isLoggedIn();
$currentUser = $isLoggedIn ? getCurrentUser() : null;
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Far Cry 3 - Визначення божевілля</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <header>
        <div class="header-wrapper">
            <div class="header-content">

                <div class="logo-section">
                    <a href="#home" class="logo">
                        <span class="logo-far">FAR</span>
                        <span class="logo-cry">CRY</span>
                        <span class="logo-number">3</span>
                    </a>
                    <p class="tagline">Rook Islands Adventure</p>
                </div>

                <button class="burger-menu" id="burgerMenu" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="nav-wrapper" id="navWrapper">
                    <nav>
                        <ul>
                            <li><a href="#home">Головна</a></li>
                            <li><a href="#about">Про гру</a></li>
                            <li><a href="#gameplay">Геймплей</a></li>
                            <li><a href="#characters">Персонажі</a></li>
                            <li><a href="#gallery">Галерея</a></li>
                        </ul>
                    </nav>

                    <div class="header-actions">
                        <?php if ($isLoggedIn): ?>
                            <span class="user-name">
                                 <?= htmlspecialchars($currentUser['login']) ?>
                            </span>

                            <?php if (isAdmin()): ?>
                                <a href="php/admin_page.php" class="btn"> Адмін</a>
                            <?php else: ?>
                                <a href="php/user_page.php" class="btn"> Профіль</a>
                            <?php endif; ?>

                            <a href="php/logout.php" class="btn btn-logout">Вийти</a>

                        <?php else: ?>
                            <a href="php/login.php" class="btn">Увійти</a>
                            <a href="php/register.php" class="btn btn-register">Реєстрація</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <main>
        <div class="container">

            <section id="home">
                <h1>Ласкаво просимо у Far Cry 3</h1>
                <p>Far Cry 3 — культовий шутер від першої особи, дія якого відбувається на загадкових островах Rook
                    Islands. Занурся у світ божевілля, пригод та виживання!</p>

                <div class="home-widgets">
                    <div id="timerWidget" class="widget timer-widget">
                        <p class="widget-title"> До виходу Far Cry 3 (10-та річниця)</p>
                        <div id="countdown" class="timer-display"></div>
                    </div>
                    <div id="clockWidget" class="widget clock-widget">
                        <p class="widget-title"> Час на Островах Рук</p>
                        <div id="digitalClock" class="clock-display"></div>
                    </div>
                </div>

            </section>

            <section id="about">
                <div class="info-grid info-grid-no-margin">

                    <div class="info-card">
                        <div class="card-title-icon">🌴</div>
                        <h2 class="card-title">ПРО ГРУ</h2>
                        <p>Far Cry 3 - це пригодницький шутер від першої особи у відкритому світі. Досліджуйте тропічний
                            острів Rook Islands площею понад 40 кв. км, повний небезпечних джунглів, таємничих храмів та
                            піратських таборів.</p>
                        <p class="paragraph-margin-top">Гравці за Джейсона Броуді, ви пройдете шлях від звичайного
                            туриста до досвідченого воїна племені Ракьят.</p>

                        <h3 class="system-requirements-heading">СИСТЕМНІ ВИМОГИ</h3>
                        <ul class="system-requirements-list">
                            <li>• OS: Windows 10 64-bit</li>
                            <li>• CPU: Intel Core i5</li>
                            <li>• RAM: 8 GB</li>
                            <li>• GPU: NVIDIA GTX 660</li>
                            <li>• DirectX: Version 11</li>
                            <li>• HDD: 20 GB вільного місця</li>
                        </ul>
                    </div>

                    <div class="info-card info-card-full-width-bg">
                        <h2 class="about-grid-title"> ОСТРІВ ROOK - ТРОПІЧНИЙ РАЙ АБО ПЕКЛО?</h2>

                        <div class="info-grid">
                            <div class="info-card eco-title">
                                <div class="card-title-icon">🌿</div>
                                <h3 class="card-title">ЕКОСИСТЕМА</h3>
                                <p class="character-details">Густі джунглі, водоспади, печери, пляжі. Понад 20 видів
                                    тварин - від мирних кабанів до смертельних комодських варанів.</p>
                            </div>

                            <div class="info-card history-title">
                                <div class="card-title-icon"></div>
                                <h3 class="card-title">ІСТОРІЯ</h3>
                                <p class="character-details">Давні храми племені Ракьят, японські бункери часів Другої
                                    світової, покинуті піратські бази.</p>
                            </div>

                            <div class="info-card danger-title">
                                <div class="card-title-icon"></div>
                                <h3 class="card-title">НЕБЕЗПЕКИ</h3>
                                <p class="character-details">Піратські патрулі, мінні поля, хижаки в джунглях. Кожен
                                    крок може стати останнім для необережного мандрівника.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="gameplay">
                <h2 class="gameplay-text-margin"> ГЕЙМПЛЕЙ</h2>
                <p>Відкритий світ з безліччю можливостей:</p>

                <div class="features-grid info-grid">

                    <div class="feature-card info-card">
                        <h3>Полювання та Крафт</h3>
                        <p>Полювання на екзотичних тварин (тигри, ведмеді, акули) та збір рослин для крафту
                            медикаментів, спорядження та поліпшень зброї.</p>
                    </div>

                    <div class="feature-card info-card">
                        <h3>Захоплення Аванпостів</h3>
                        <p>Звільніть ворожі бази (аванпости) у стилі стелс або вступайте у відкритий бій, щоб
                            розблокувати нові зони та місії.</p>
                    </div>

                    <div class="feature-card info-card">
                        <h3>Прокачка Навичок</h3>
                        <p>Прокачайте Джейсона від звичайного туриста до Воїна Джунглів, вивчаючи нові бойові прийоми та
                            здібності через священне татуювання.</p>
                    </div>

                    <div class="feature-card info-card">
                        <h3>Транспорт та Дослідження</h3>
                        <p>Використовуйте машини, човни та дельтаплани, щоб досліджувати кожен куточок острова та
                            знаходити таємні схованки.</p>
                    </div>

                    <div class="feature-card info-card">
                        <h3>Захоплення Аванпостів</h3>
                        <p>Штурмуйте піратські бази, звільняйте території та відкривайте нові точки швидкого переміщення
                            по острову.</p>
                    </div>

                    <div class="feature-card info-card">
                        <h3>Полювання та Крафт</h3>
                        <p>Полюйте на диких тварин, збирайте рідкісні ресурси та створюйте спорядження, що покращує ваші
                            можливості.</p>
                    </div>
                </div>
            </section>

            <section id="characters">
                <h2 class="section-title-margin"> ГОЛОВНІ ПЕРСОНАЖІ</h2>

                <div class="characters-grid">

                    <div class="info-card character-card char-jason">
                        <div class="character-image-placeholder">
                            <img src="img/jason.jpeg" alt="Джейсон Броуді" class="character-photo">
                        </div>
                        <div class="card-title-icon">👤</div>
                        <h3 class="card-title">ДЖЕЙСОН БРОУДІ</h3>
                        <p class="character-role">ПРОТАГОНІСТ</p>
                        <p class="character-details">24-річний турист, змушений стати воїном. Проходить шлях від туриста
                            до воїна Ракьят.</p>
                        <p class="character-role">НАВИЧКА: ВОЇН ДЖУНГЛІВ</p>
                    </div>

                    <div class="info-card character-card char-vaas">
                        <div class="character-image-placeholder">
                            <img src="img/vaas.jpg" alt="Ваас Монтенегро" class="character-photo">
                        </div>
                        <div class="card-title-icon"></div>
                        <h3 class="card-title">ВААС МОНТЕНЕГРО</h3>
                        <p class="character-role">АНТАГОНІСТ</p>
                        <p class="character-details">Безумний лідер піратів. Непередбачуваний психопат з філософськими
                            поглядами на божевілля.</p>
                        <p class="character-role">ОСОБЛИВІСТЬ: НЕПЕРЕДБАЧУВАНІСТЬ</p>
                    </div>

                    <div class="info-card character-card char-citra">
                        <div class="character-image-placeholder">
                            <img src="img/citra.jpg" alt="Цитра Талугмай" class="character-photo">
                        </div>
                        <div class="card-title-icon"></div>
                        <h3 class="card-title">ЦИТРА ТАЛУГМАЙ</h3>
                        <p class="character-role">СОЮЗНИЦЯ</p>
                        <p class="character-details">Лідерка племені Ракьят. Вірить у пророцтво про воїна-визволителя і
                            є наставницею Джейсона.</p>
                        <p class="character-role">РОЛЬ: НАСТАВНИЦЯ</p>
                    </div>

                    <div class="info-card character-card char-hoyt">
                        <div class="character-image-placeholder">
                            <img src="img/hoyt.jpg" alt="Хойт Волкер" class="character-photo">
                        </div>
                        <div class="card-title-icon"></div>
                        <h3 class="card-title">ХОЙТ ВОЛКЕР</h3>
                        <p class="character-role">ГОЛОВНИЙ ЛИХОДІЙ</p>
                        <p class="character-details">Південноафриканський наркобарон та работоргівець. Контролює
                            південну частину острова.</p>
                        <p class="character-role">ВЛАДА: ПІВДЕННІ ТЕРИТОРІЇ</p>
                    </div>

                </div>
            </section>

            <section id="gallery">
                <h2> Галерея</h2>

                <div class="gallery-grid">
                    <img src="img/forest.jpg" alt="Far Cry 3 - Rook Forest">
                    <img src="img/Island.jpg" alt="Far Cry 3 - Rook Islands">
                    <img src="img/Jungle.jpg" alt="Far Cry 3 - Rook Jungle">
                    <img src="img/Terrorist.jpg" alt="Far Cry 3 - Rook Terrorist">
                </div>
            </section>

        </div>
    </main>

    <footer>
        <p>© 2025 Far Cry 3 Fan Site | Розроблено для лабораторної роботи №4</p>
        <p class="footer-trademark">Far Cry 3 є торговою маркою Ubisoft Entertainment</p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>