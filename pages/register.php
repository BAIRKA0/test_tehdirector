<?php
require 'user.php';

redirectIfLoggedIn();

$email = '';
$successMessage = '';

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
        if (registerUser($email, $password)) {
            $_SESSION['success_message'] = "Регистрация прошла успешно! Вы можете войти в свой аккаунт.";
            header('Location: login.php');
            exit;
        } else {
            $error = "Ошибка регистрации";
        }
    }
}
$title = "Регистрация";
require 'header.php';
?>
<div class="cont">
    <h2>Регистрация</h2>
    <form method="POST">
        <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
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
<?php require 'footer.php'; ?>
