<?php
include 'db.php';
$message = '';

if(isset($_POST['add'])){
    $id = $_POST['id'];
    $dex_number = $_POST['dex_number'];
    $name = $_POST['name'];
    $type1 = $_POST['type1'];
    $type2 = $_POST['type2'] ?: null;
    $image_path = $_POST['image_path'];

    $stmt = $pdo->prepare("INSERT INTO pokemon (id, dex_number, name, type1, type2, image_path) VALUES (:id, :dex_number, :name, :type1, :type2, :image_path)");

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

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM pokemon WHERE id=:id");
    $stmt->execute(['id'=>$id]);
    $message = "Pokémon verwijderd!";
}

// Reset caught
if(isset($_POST['reset_caught'])){
    $stmt = $pdo->prepare("UPDATE pokemon SET caught = 0");
    $stmt->execute();
    $message = "✅ Alle Pokémon zijn nu weer niet gevangen!";
}

$stmt = $pdo->query("SELECT * FROM pokemon ORDER BY dex_number");
$pokemon = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Admin Panel</h1>

<?php if($message): ?>
<div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<h2>Voeg Pokémon toe</h2>
<form method="POST">
    <input type="number" name="id" placeholder="id" required>
    <input type="number" name="dex_number" placeholder="Dex Number" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="type1" placeholder="Type 1" required>
    <input type="text" name="type2" placeholder="Type 2 (optioneel)">
    <input type="text" name="image_path" placeholder="images/25.png" required>
    <button type="submit" name="add">Add Pokémon</button>
</form>

<form method="POST">
    <button type="submit" name="reset_caught">Reset gevangen status</button>
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
    <tr>
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