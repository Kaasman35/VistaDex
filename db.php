<?php

$host = "localhost";
$db = "pokedexdb";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}