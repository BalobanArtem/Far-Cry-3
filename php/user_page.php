<?php
require_once 'config.php';
requireLogin();

$currentUser = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Особистий кабінет - Far Cry 3</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div>
                <h1> Особистий кабінет</h1>
                <div class="page-info">
                    Вітаємо, <strong><?= htmlspecialchars($currentUser['login']) ?></strong>!
                </div>
            </div>
            <div class="page-actions">
                <a href="../index.php" class="btn"> Головна</a>
                <a href="logout.php" class="btn btn-logout">Вийти</a>
            </div>
        </div>
        
        <div class="profile-card">
            <h2> Інформація про профіль</h2>
            <div class="profile-info">
                <div class="info-row">
                    <div class="info-label">ID користувача:</div>
                    <div class="info-value"><?= $currentUser['id'] ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Логін:</div>
                    <div class="info-value"><?= htmlspecialchars($currentUser['login']) ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?= htmlspecialchars($currentUser['email']) ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Стать:</div>
                    <div class="info-value">
                        <?= $currentUser['gender'] === 'male' ? ' Чоловік' : ' Жінка' ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Роль:</div>
                    <div class="info-value">
                        <span class="role-badge role-user">
                            <?= strtoupper($currentUser['role']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <h3> Ігрові досягнення</h3>
                <p>Відстежуйте свій прогрес у грі Far Cry 3. Відкривайте нові досягнення та ділитесь ними з друзями!</p>
            </div>
            
            <div class="feature-card">
                <h3> Форум</h3>
                <p>Обговорюйте стратегії проходження, діліться порадами та знаходьте нових союзників!</p>
            </div>
            
            <div class="feature-card">
                <h3> Статистика</h3>
                <p>Переглядайте детальну статистику своїх ігрових сесій, кількість вбитих ворогів та пройдених місій.</p>
            </div>
        </div>
        
        <div style="background: rgba(224, 169, 91, 0.1); border: 2px solid #e0a95b; padding: 30px; border-radius: 12px; text-align: center;">
            <h3 style="color: #e0a95b; margin-bottom: 15px; font-size: 22px;"> Ексклюзивний контент</h3>
            <p style="color: #b4c9c7; line-height: 1.8; font-size: 15px;">
                Ви отримали доступ до ексклюзивних матеріалів, секретних місій та спеціальної зброї!
                Продовжуйте грати та відкривайте нові можливості.
            </p>
        </div>
    </div>
</body>
</html>