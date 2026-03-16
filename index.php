<?php

$host = "localhost";
$db = "pokedexdb";
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


$sql = "SELECT * FROM pokemon WHERE 1";
$params = [];

if($search){
    $sql .= " AND (name LIKE :search OR dex_number LIKE :search)";
    $params['search'] = "%$search%";
}

if($type){
    $sql .= " AND (type1 = :type OR type2 = :type)";
    $params['type'] = $type;
}

$allowedSort = ['dex_number','name','type1'];
if(!in_array($sort,$allowedSort)) $sort = 'dex_number';
$sql .= " ORDER BY $sort";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$pokemon = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokédex</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<h1>Pokédex</h1>


<form method="GET">
    <input 
        type="text" 
        name="search" 
        placeholder="Search Pokémon..." 
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
    >
    
    <select name="type">
        <option value="">All types</option>
        <option value="Fire" <?= ($type=='Fire')?'selected':'' ?>>Fire</option>
        <option value="Water" <?= ($type=='Water')?'selected':'' ?>>Water</option>
        <option value="Grass" <?= ($type=='Grass')?'selected':'' ?>>Grass</option>
        <option value="Electric" <?= ($type=='Electric')?'selected':'' ?>>Electric</option>
        <option value="Psychic" <?= ($type=='Psychic')?'selected':'' ?>>Psychic</option>
        <option value="Ground" <?= ($type=='Ground')?'selected':'' ?>>Ground</option>
    </select>

    <select name="sort">
        <option value="dex_number" <?= ($sort=='dex_number')?'selected':'' ?>>Dex Number</option>
        <option value="name" <?= ($sort=='name')?'selected':'' ?>>Name</option>
        <option value="type1" <?= ($sort=='type1')?'selected':'' ?>>Type</option>
    </select>

    <button type="submit">Apply</button>
</form>


<div class="pokedex">
<?php foreach($pokemon as $p): ?>
<div class="card">
    <img src="<?= htmlspecialchars($p['image_path']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
    <h2>#<?= $p['dex_number'] ?> <?= htmlspecialchars($p['name']) ?></h2>
    <p>
        <?= htmlspecialchars($p['type1']) ?>
        <?= $p['type2'] ? " / ".htmlspecialchars($p['type2']) : "" ?>
    </p>
</div>
<?php endforeach; ?>
</div>

</body>
</html>