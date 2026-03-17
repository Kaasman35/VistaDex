<?php
include 'db.php';

$id = $_POST['id'] ?? null;
if(!$id){
    header("Location: index.php");
    exit;
}

// 50% kans om te vangen
$chance = rand(1, 100);

if($chance <= 50){
    $stmt = $pdo->prepare("UPDATE pokemon SET caught = 1 WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: pokemon_detail.php?id=$id&msg=success");
} else {
    header("Location: pokemon_detail.php?id=$id&msg=fail");
}