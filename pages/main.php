<?php
require 'user.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$api_url = 'https://catfact.ninja/fact';
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$cat_fact = $data['fact'] ?? 'Не удалось получить факт о кошках';

if (isset($_POST['logout'])) {
    logoutUser();
}

$title = "Главная страница";
require 'header.php';
?>
<h2>Вы авторизовались</h2>
<form method="POST">
    <button type="submit" name="logout" class="btn btn-danger">Выйти</button>
</form>
<div class="mt-4">
    <h4>Факт о кошках:</h4>
    <p><?php echo htmlspecialchars($cat_fact, ENT_QUOTES, 'UTF-8'); ?></p>
</div>
<?php require 'footer.php'; ?>
