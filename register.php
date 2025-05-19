<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, 1)")
        ->execute([$_POST['name'], $_POST['email'], $hash]);
    header("Location: login.php");
}
?>
<form method="POST">
    <input name="name" placeholder="Имя">
    <input name="email" placeholder="Email">
    <input name="password" type="password" placeholder="Пароль">
    <button>Зарегистрироваться</button>
</form>
