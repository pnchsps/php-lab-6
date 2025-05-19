<?php
require_once '../header.php';

if (!$user || $user['role_id'] != 2) {
    exit("Доступ запрещён");
}

$stmt = $pdo->query("SELECT * FROM events ORDER BY date ASC");

echo '<a href="add_registration.php">Добавить мероприятие</a><br><br>';

foreach ($stmt as $event) {
    echo "<div>
        <b>" . htmlspecialchars($event['name']) . "</b> - " . $event['date'] . "
        <a href='add_registration.php?id=" . $event['id'] . "'>Редактировать</a>
    </div>";
}
?>