<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $token = bin2hex(random_bytes(16));
        $pdo->prepare("UPDATE users SET token = ? WHERE id = ?")->execute([$token, $user['id']]);
        setcookie('token', $token, time() + 3600, "/");
        header("Location: events.php");
        exit;
    } else {
        echo "Неверный логин или пароль";
    }
}
?>
<form method="POST">
    <input name="email" placeholder="Email">
    <input name="password" type="password" placeholder="Пароль">
    <button>Войти</button>
</form>
