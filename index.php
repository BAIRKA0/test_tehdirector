<?php
session_start();

// Если пользователь авторизован, перенаправляем на внутреннюю страницу
if (isset($_SESSION['user'])) {
    header('Location: pages/dashboard.php');
    exit;
}

// Если не авторизован, перенаправляем на страницу авторизации
header('Location: pages/login.php');
exit;
