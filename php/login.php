<?php
require_once 'config.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: admin_page.php');
    } else {
        header('Location: user_page.php');
    }
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($login) || empty($password)) {
        $error = 'Заповніть всі поля!';
    } else {
        if (loginUser($login, $password)) {
            if (isAdmin()) {
                header('Location: admin_page.php');
            } else {
                header('Location: user_page.php');
            }
            exit;
        } else {
            $error = 'Невірний логін або пароль!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід - Far Cry 3</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="auth-page">

<div class="auth-box">
    <h2>🎮 Вхід в систему</h2>

    <div id="jsError" class="error" style="display:none;"></div>

    <?php if ($error): ?>
        <div class="error">❌ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" id="loginForm">
        <input type="text" name="login" id="login" placeholder="Логін" required>
        <input type="password" name="password" id="password" placeholder="Пароль" required>
        <button type="submit">Увійти</button>
    </form>

    <a href="register.php">Зареєструватися</a>
    <a href="../index.php">← Повернутися на головну</a>

    <div style="background: rgba(224, 169, 91, 0.1); border: 1px solid #e0a95b; color: #e0a95b; padding: 15px; border-radius: 5px; margin-top: 20px; text-align: center; font-size: 13px;">
        💡 <strong>Для тестування:</strong><br>
        Адмін: <code>admin</code> / <code>admin123</code>
    </div>
</div>

<script src="../js/script.js"></script>
</body>
</html>
