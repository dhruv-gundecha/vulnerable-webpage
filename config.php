<?php
$dsn = "mysql:host=localhost;dbname=ccdc;charset=utf8mb4";
$db_user = "root";       // Set your DB username
$db_pass = "mypass";   // Set your DB password

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
