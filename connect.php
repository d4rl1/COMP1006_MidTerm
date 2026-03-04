<?php
$dsn = 'mysql:host=localhost;dbname=book_manager';
$user = 'root';
$password = '';
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected successfully';
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}