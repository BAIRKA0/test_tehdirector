<?php
require '../db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirectIfLoggedIn()
{
    if (isset($_SESSION['user'])) {
        header('Location: main.php');
        exit;
    }
}

function registerUser($email, $password)
{
    global $pdo;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    return $stmt->execute([$email, $passwordHash]);
}

function loginUser($email, $password)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['email'];
        return true;
    }

    return false;
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function logoutUser()
{
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
