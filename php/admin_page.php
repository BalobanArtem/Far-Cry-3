<?php
require_once 'config.php';
requireAdmin();

$users = loadUsers();
$totalUsers = count($users);

$maleCount = 0;
$femaleCount = 0;
foreach ($users as $user) {
    if ($user['gender'] === 'male') $maleCount++;
    else $femaleCount++;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Панель адміністратора - Far Cry 3</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <div class="page-header page-header-admin">
            <div>
                <h1> Панель адміністратора</h1>
                <div class="page-info">
                    Вітаємо, <strong><?= htmlspecialchars($_SESSION['login']) ?></strong>!
                </div>
            </div>
            <div class="page-actions">
                <a href="../index.php" class="btn"> Головна</a>
                <a href="logout.php" class="btn btn-logout">Вийти</a>
            </div>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3><?= $totalUsers ?></h3>
                <p>Всього користувачів</p>
            </div>
            
            <div class="stat-card">
                <h3><?= $maleCount ?></h3>
                <p>Чоловіків</p>
            </div>
            
            <div class="stat-card">
                <h3><?= $femaleCount ?></h3>
                <p>Жінок</p>
            </div>
            
            <div class="stat-card">
                <h3>1</h3>
                <p>Адміністраторів</p>
            </div>
        </div>
        
        <div class="users-table">
            <h2> Список користувачів</h2>
            
            <?php if (empty($users)): ?>
                <p style="color: #8fa8a5; text-align: center; padding: 30px;">
                    Поки що немає зареєстрованих користувачів
                </p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логін</th>
                            <th>Email</th>
                            <th>Стать</th>
                            <th>Роль</th>
                            <th>Дата реєстрації</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= htmlspecialchars($user['login']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= $user['gender'] === 'male' ? ' Чоловік' : ' Жінка' ?></td>
                                <td>
                                    <span class="role-badge role-<?= $user['role'] ?? 'user' ?>">
                                        <?= $user['role'] ?? 'user' ?>
                                    </span>
                                </td>
                                <td><?= $user['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>