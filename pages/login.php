<?php
require 'user.php';

redirectIfLoggedIn();

$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email) || empty($password)) {
        $error = "Все поля должны быть заполнены!";
    } else {
        if (loginUser($email, $password)) {
            header('Location: main.php');
            exit;
        } else {
            $error = "Логин или пароль введены неверно";
        }
    }
}

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success_message'], ENT_QUOTES, 'UTF-8') . "</div>";
    unset($_SESSION['success_message']);
}

$title = "Авторизация";
require 'header.php';
?>
<div class="cont">
    <h2>Авторизация</h2>
    <form method="POST">
    <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <a href="register.php" class="link">Нет аккаунта? Зарегистрироваться</a>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
</div>
<?php require 'footer.php'; ?>
