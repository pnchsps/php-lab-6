<?php
require_once '../config.php';

if (!empty($_POST['id'])) {
    $stmt = $pdo->prepare("UPDATE events SET name = ?, price = ?, number_seats = ?, date = ? WHERE id = ?");
    $stmt->execute([$_POST['name'], $_POST['price'], $_POST['number_seats'], $_POST['date'], $_POST['id']]);
} else {
    $stmt = $pdo->prepare("INSERT INTO events (name, price, number_seats, date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['price'], $_POST['number_seats'], $_POST['date']]);
}

header("Location: event_list.php");
