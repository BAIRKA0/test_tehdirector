<?php
$api_url = 'https://catfact.ninja/fact';
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$cat_fact = $data['fact'] ?? 'Не удалось получить факт о кошках';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="../css/test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <h2>Вы авторизовались</h2>
    <a href="login.php" class="link">Выйти</a>
    <div class="mt-4">
        <h4>Факт о кошках:</h4>
        <p><?php echo htmlspecialchars($cat_fact, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</body>
</html>
