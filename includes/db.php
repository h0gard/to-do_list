<?php
//$dsn = 'mysql:host=localhost;dbname=to-do';
//$pdo = new PDO($dsn, 'root', 'mysql');


$host = 'localhost';
$dbname = 'to-do';
$username = 'root';
$password = 'mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
