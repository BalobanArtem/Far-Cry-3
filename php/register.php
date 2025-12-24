<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm'] ?? '');
    $gender = $_POST['gender'] ?? 'male';

    // ===== ВАЛІДАЦІЯ =====
    if ($login === '' || $email === '' || $password === '' || $confirm === '') {
        $error = "Заповніть всі поля!";
    } elseif (strcasecmp($login, ADMIN_LOGIN) === 0) {
        $error = "Цей логін зарезервований для адміністратора!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Невірний формат email!";
    } elseif (strcasecmp($email, ADMIN_EMAIL) === 0) {
        $error = "Цей email зарезервований для адміністратора!";
    } elseif ($password !== $confirm) {
        $error = "Паролі не співпадають!";
    } elseif (strlen($password) < 6) {
        $error = "Пароль має бути не менше 6 символів!";
    } else {
        $users = loadUsers();

        $loginExists = false;
        $emailExists = false;

        foreach ($users as $user) {
            if (strcasecmp($user['login'], $login) === 0) {
                $loginExists = true;
                break;
            }
            if (strcasecmp($user['email'], $email) === 0) {
                $emailExists = true;
                break;
            }
        }

        if ($loginExists) {
            $error = "Користувач з таким логіном вже існує!";
        } elseif ($emailExists) {
            $error = "Користувач з таким email вже існує!";
        } else {
            $newUser = [
                'id' => count($users) + 1,
                'login' => htmlspecialchars($login, ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'gender' => $gender,
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $users[] = $newUser;

            if (saveUsers($users)) {
                $success = "Реєстрація успішна! Тепер ви можете увійти в систему.";
                $_POST = [];
            } else {
                $error = "Помилка збереження! Перевірте права доступу до папки php/";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація - Far Cry 3</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body class="auth-page">

    <div class="auth-box">
        <h2> Реєстрація</h2>

        <?php if ($error): ?>
            <div class="error"> <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"> <?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="login" placeholder="Логін" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
                required>

            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required>

            <input type="password" name="password" placeholder="Пароль (мін. 6 символів)" required>

            <input type="password" name="confirm" placeholder="Повторіть пароль" required>

            <select name="gender">
                <option value="male" <?= ($_POST['gender'] ?? 'male') === 'male' ? 'selected' : '' ?>>
                     Чоловік
                </option>
                <option value="female" <?= ($_POST['gender'] ?? '') === 'female' ? 'selected' : '' ?>>
                     Жінка
                </option>
            </select>

            <button type="submit">Зареєструватися</button>
        </form>

        <a href="login.php">Вже є акаунт? Увійти</a>
        <a href="../index.php">← Повернутися на головну</a>
    </div>

</body>

</html>