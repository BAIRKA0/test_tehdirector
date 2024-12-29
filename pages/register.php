<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Все поля должны быть заполнены!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Электронная почта введена некорректно";
    } elseif (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)) {
        $error = "Пароль должен содержать только латинские символы и цифры и быть не менее 8 символов";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        if ($stmt->execute([$email, $passwordHash])) {
            header('Location: login.php');
            exit;
        } else {
            $error = "Ошибка регистрации";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="cont">
        <h2>Регистрация</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
        <a href="login.php" class="link">Уже есть аккаунт? Войти</a>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    </div>
</body>
</html>
