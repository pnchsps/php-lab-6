<?php
require_once '../header.php';
if ($user['role_id'] != 2) exit("Доступ запрещён");
$stmt = $pdo->query("
    SELECT u.name, e.name AS event_name FROM event_records r
    JOIN users u ON r.user_id = u.id
    JOIN events e ON r.event_id = e.id
");
foreach ($stmt as $row) {
    echo "{$row['name']} записан на {$row['event_name']}<br>";
}
?>
