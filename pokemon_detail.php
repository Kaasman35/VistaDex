<?php
include 'db.php';
$id = $_GET['id'] ?? 1;

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE id = :id");
$stmt->execute(['id'=>$id]);
$pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$pokemon) die("Pokémon not found.");

$msg = '';
if(isset($_GET['msg'])){
    $msg = $_GET['msg'] == 'success' ? '🎉 Pokémon gevangen!' : '❌ Hij ontsnapte!';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($pokemon['name']) ?></title>
<style>
.card { display:inline-block; border:5px solid #e5be10; padding:20px; border-radius:10px; width:300px; height:350px; text-align:center; background-color:#f5f5f5; }
.card img { width:150px; height:150px; filter: <?= $pokemon['caught'] ? 'blur(0)' : 'blur(8px)' ?>; transition:0.3s; }
button { padding:8px 15px; cursor:pointer; border:none; border-radius:5px; background:#ff5350; color:white; margin-top:10px; }
body{ display:flex; justify-content:center; align-items:center; flex-direction:column; min-height:100vh; font-family: Arial; }
.message { margin:10px 0; font-weight:bold; }
</style>
</head>
<body>

<?php if($msg) echo "<div class='message'>$msg</div>"; ?>

<div class="card">
<h2><?= htmlspecialchars($pokemon['name']) ?></h2>
<p>Dex Number: <?= $pokemon['dex_number'] ?></p>
<p>Type 1: <?= $pokemon['type1'] ?></p>
<p><?= $pokemon['type2'] ? 'Type 2: '.$pokemon['type2'] : '' ?></p>
<img src="<?= htmlspecialchars($pokemon['image_path']) ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>">

<?php if(!$pokemon['caught']): ?>
<form method="POST" action="catch.php">
<input type="hidden" name="id" value="<?= $pokemon['id'] ?>">
<button type="submit">Gooi Pokéball 🎯</button>
</form>
<?php else: ?>
<p>✅ Gevangen!</p>
<?php endif; ?>
</div>

</body>
</html>