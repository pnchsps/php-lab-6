<?php
require_once '../config.php';

$event = ['name' => '', 'price' => '', 'number_seats' => '', 'date' => ''];
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
?>

<form method="POST" action="event_edit.php">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input name="name" placeholder="Название" value="<?= htmlspecialchars($event['name']) ?>">
    <input name="price" placeholder="Цена" value="<?= $event['price'] ?>">
    <input name="number_seats" placeholder="Места" value="<?= $event['number_seats'] ?>">
    <input name="date" type="datetime-local" value="<?= str_replace(' ', 'T', $event['date']) ?>">
    <button>Сохранить</button>
</form>
