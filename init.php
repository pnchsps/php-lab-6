<?php
$pdo = new PDO('mysql:host=localhost;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec("CREATE DATABASE IF NOT EXISTS event_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
$pdo->exec("USE event_platform");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS roles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
    );
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        token VARCHAR(255),
        role_id INT,
        FOREIGN KEY (role_id) REFERENCES roles(id)
    );
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        price DECIMAL(10, 2),
        number_seats INT,
        date DATETIME
    );
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS event_records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        event_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (event_id) REFERENCES events(id)
    );
");

$pdo->exec("INSERT IGNORE INTO roles (id, name) VALUES (1, 'user'), (2, 'manager')");

echo 'Инициализация завершена.';
?>