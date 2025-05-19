<?php
require_once 'config.php';

$token = $_COOKIE['token'] ?? '';
$user = null;

if ($token) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
}
?>
<nav>
    <a href="/event_platform/events.php">Мероприятия</a>

    <?php if ($user && $user['role_id'] == 2): ?>
        <a href="/event_platform/admin/event_list.php">Панель администратора</a>
    <?php endif; ?>

    <?php if ($user): ?>
        <a href="/event_platform/logout.php">Выход</a>
    <?php else: ?>
        <a href="/event_platform/login.php">Вход</a>
        <a href="/event_platform/register.php">Регистрация</a>
    <?php endif; ?>
</nav>
