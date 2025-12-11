<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

define('ADMIN_LOGIN', 'admin');
define('ADMIN_PASSWORD', 'admin123');
define('ADMIN_EMAIL', 'admin@farcry3.com');

define('USERS_FILE', __DIR__ . '/users.json');

function loadUsers() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    
    $jsonContent = file_get_contents(USERS_FILE);
    $users = json_decode($jsonContent, true);
    
    return is_array($users) ? $users : [];
}

function saveUsers($users) {
    $jsonData = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents(USERS_FILE, $jsonData, LOCK_EX);
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['login']);
}

function isAdmin() {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id'     => $_SESSION['user_id'],
        'login'  => $_SESSION['login'],
        'email'  => $_SESSION['email'],
        'role'   => $_SESSION['role'],
        'gender' => $_SESSION['gender'] ?? 'male'
    ];
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function requireAdmin() {
    requireLogin();
    
    if (!isAdmin()) {
        header('Location: user_page.php');
        exit;
    }
}

function loginUser($login, $password) {

    if ($login === ADMIN_LOGIN && $password === ADMIN_PASSWORD) {
        $_SESSION['user_id'] = 0;
        $_SESSION['login']  = ADMIN_LOGIN;
        $_SESSION['email']  = ADMIN_EMAIL;
        $_SESSION['role']   = 'admin';
        $_SESSION['gender'] = 'male';
        return true;
    }

    $users = loadUsers();

    foreach ($users as $user) {
        if ($user['login'] === $login && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login']  = $user['login'];
            $_SESSION['email']  = $user['email'];
            $_SESSION['role']   = $user['role'];
            $_SESSION['gender'] = $user['gender'];

            return true;
        }
    }

    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit;
}
?>