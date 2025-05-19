<?php include 'header.php'; ?>
<h2>Доступные мероприятия</h2>
<?php
$stmt = $pdo->query("SELECT * FROM events ORDER BY date ASC");
foreach ($stmt as $event): ?>
    <div>
        <b><?= htmlspecialchars($event['name']) ?></b><br>
        <?= $event['date'] ?> | <?= $event['price'] ?>₽ | Мест: <?= $event['number_seats'] ?><br>
        <?php if ($user): ?>
            <a href="record.php?event_id=<?= $event['id'] ?>">Записаться</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
