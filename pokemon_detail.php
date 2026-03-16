<?php
include 'db.php';
$id = $_GET['id'] ?? 1;

$sql = "SELECT * FROM pokemon WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$pokemon){
    die("Pokémon not found.");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="card">
    <h2><?= htmlspecialchars($pokemon['name']) ?></h2>
    <p>Dex Number: <?= htmlspecialchars($pokemon['dex_number']) ?></p>
    <p>Type 1: <?= htmlspecialchars($pokemon['type1']) ?></p>
    <p> <?= $pokemon['type2'] ? 'Type 2: ' . htmlspecialchars($pokemon['type2']) : '' ?></p>
     <img src="<?= htmlspecialchars($pokemon['image_path']) ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>">
    
</div>
<style>
.card {
    display:inline-block;
    border:5px solid #e5be10;
    padding:20px;
    border-radius:10px;
    width:300px;
    height:300px;
    text-align:center;
        background-color:#f5f5f5; 
}
.card img {
    width:150px;
    height:150px;
}
body{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
</style>
</body>
</html>