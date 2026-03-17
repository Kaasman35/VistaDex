<?php

$host = "localhost";
$db = "db_pokedex";
$user = "root";
$pass = "";

$search = $_GET['search'] ?? '';
$type   = $_GET['type'] ?? '';
$sort   = $_GET['sort'] ?? 'dex_number';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}