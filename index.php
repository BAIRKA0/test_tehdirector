<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: pages/main.php');
    exit;
}
header('Location: pages/login.php');
exit;
?>
