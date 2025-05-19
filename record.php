<?php
require_once 'header.php';
if (!$user) exit("Требуется вход");

$event_id = (int)$_GET['event_id'];

$check = $pdo->prepare("SELECT COUNT(*) FROM event_records WHERE user_id = ? AND event_id = ?");
$check->execute([$user['id'], $event_id]);
if ($check->fetchColumn() > 0) {
    echo "Вы уже записаны на это мероприятие.";
    exit;
}

$checkSeats = $pdo->prepare("SELECT number_seats FROM events WHERE id = ?");
$checkSeats->execute([$event_id]);
$seats = $checkSeats->fetchColumn();

if ($seats <= 0) {
    echo "Свободных мест больше нет.";
    exit;
}

$pdo->prepare("INSERT INTO event_records (user_id, event_id) VALUES (?, ?)")
    ->execute([$user['id'], $event_id]);

$pdo->prepare("UPDATE events SET number_seats = number_seats - 1 WHERE id = ?")
    ->execute([$event_id]);

echo "Вы успешно записались!";
?>
<a href="events.php">Назад</a>
