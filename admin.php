<?php
$host = "localhost";
$db = "pokedexdb";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch(PDOException $e){
    die("Database error: ".$e->getMessage());
}

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
<style>
body{ font-family: Arial; padding:20px; background:#f2f2f2; }
h1{text-align:center;}
form, table{ background:white; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2); margin:auto; margin-bottom:20px; width:600px; }
input{ width:100%; padding:10px; margin:5px 0; border-radius:6px; border:1px solid #ccc; }
button{ padding:10px 15px; border:none; border-radius:6px; background:#ff5350; color:white; cursor:pointer; }
button:hover{ background:#e04343; }
.message{ text-align:center; margin-bottom:10px; color:green; font-weight:bold; }
table{ width:100%; border-collapse:collapse; }
th, td{ padding:10px; border-bottom:1px solid #ccc; text-align:left; }
a.delete{ color:red; text-decoration:none; }
a.delete:hover{ text-decoration:underline; }
</style>
</head>
<body>

<h1>Admin Panel</h1>

<?php if($message): ?>
<div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST">
    <h2>Voeg Pokémon toe</h2>
    <input type="number" name="id" placeholder="id"    required>
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