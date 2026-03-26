<?php
include 'db.php';

$id = $_POST['id'] ?? null;
$ball = $_POST['ball'] ?? 'normal';

if(!$id){
    header("Location: index.php");
    exit;
}

$chance = match($ball){
    'super' => 75,
    'ultra' => 90,
    default => 50,
};

if(rand(1,100) <= $chance){
    $stmt = $pdo->prepare("UPDATE pokemon SET caught = 1 WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: pokemon_detail.php?id=$id&msg=success");
} else {
    header("Location: pokemon_detail.php?id=$id&msg=fail");
}