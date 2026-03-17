<?php

include 'dbconn.php';

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

$message = '';

if(isset($_POST['add'])){
    $id = $_POST['id'];
    $dex_number = $_POST['dex_number'];
    $name = $_POST['name'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'] ?: null;
    $image_path = $_POST['image_path'];

    $stmt = $pdo->prepare("
        INSERT INTO pokemon (id, dex_number, name, type1, type2, image_path)
        VALUES (:id, :dex_number, :name, :type1, :type2, :image_path)
    ");

    try {
        $stmt->execute([
            'id'=>$id,
            'dex_number'=>$dex_number,
            'name'=>$name,
            'type1'=>$type1,
            'type2'=>$type2,
            'image_path'=>$image_path
        ]);
        $message = "Pokémon toegevoegd!";
    } catch(PDOException $e){
        $message = "Fout: " . $e->getMessage();
    }
}


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM pokemon WHERE id=:id");
    $stmt->execute(['id'=>$id]);
    $message = "Pokémon verwijderd!";
}

$stmt = $pdo->query("SELECT * FROM pokemon ORDER BY dex_number");
$pokemon = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<h1>Admin Panel</h1>

<?php if($message): ?>
<div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="GET">
    <input 
        type="text" 
        name="search" 
        placeholder="Search Pokémon..." 
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
    >
    
    <select name="type">
        <option value="" class="filterbutton">All types</option>
        <option value="Fire" <?= ($type=='Fire')?'selected':'' ?>>Fire</option>
        <option value="Water" <?= ($type=='Water')?'selected':'' ?>>Water</option>
        <option value="Grass" <?= ($type=='Grass')?'selected':'' ?>>Grass</option>
        <option value="Electric" <?= ($type=='Electric')?'selected':'' ?>>Electric</option>
        <option value="Psychic" <?= ($type=='Psychic')?'selected':'' ?>>Psychic</option>
        <option value="Ground" <?= ($type=='Ground')?'selected':'' ?>>Ground</option>
    </select>

    <select name="sort">
        <option value="dex_number" class="filterbutton" <?= ($sort=='dex_number')?'selected':'' ?>>Dex Number</option>
        <option value="name" <?= ($sort=='name')?'selected':'' ?>>Name</option>
        <option value="type1" <?= ($sort=='type1')?'selected':'' ?>>Type</option>
    </select>

    <button type="submit">Apply</button>
</form>


<form method="POST">
    <h2>Voeg Pokémon toe</h2>
    <input type="number" name="id" placeholder="id" required>
    <input type="number" name="dex_number" placeholder="Dex Number" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="type1" placeholder="Type 1" required>
    <input type="text" name="type2" placeholder="Type 2 (optioneel)">
    <input type="text" name="image_path" placeholder="images/25.png" required>
    <button type="submit" name="add">Add Pokémon</button>
</form>

<table>
    <tr>
        <th>#</th>
        <th>Dex</th>
        <th>Name</th>
        <th>Type 1</th>
        <th>Type 2</th>
        <th>Image</th>
        <th>Actie</th>
    </tr>
    <?php foreach($pokemon as $p): ?>
    <tr class="type-<?= strtolower($p['type1']) ?>">
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['dex_number']) ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= htmlspecialchars($p['type1']) ?></td>
        <td><?= htmlspecialchars($p['type2']) ?></td>
        <td><img src="<?= htmlspecialchars($p['image_path']) ?>" width="50"></td>
        <td><a class="delete" href="admin.php?delete=<?= $p['id'] ?>" onclick="return confirm('Weet je zeker dat je deze Pokémon wilt verwijderen?')">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>