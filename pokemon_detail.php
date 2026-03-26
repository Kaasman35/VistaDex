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
<link rel="stylesheet" href="styles.css">
</head>
<body>

<button class="back" onclick="window.location.href='index.php'">← Back to Pokédex</button>
<?php if($msg) echo "<div class='message'>$msg</div>"; ?>

<div class="card detail <?= $pokemon['caught'] ? 'caught' : '' ?> type-<?= strtolower($pokemon['type1']) ?>">
<h2><?= htmlspecialchars($pokemon['name']) ?></h2>
<p>Dex Number: <?= $pokemon['dex_number'] ?></p>
<p>Type 1: <?= htmlspecialchars($pokemon['type1']) ?></p>
<p><?= $pokemon['type2'] ? 'Type 2: '.$pokemon['type2'] : '' ?></p>
<img src="<?= htmlspecialchars($pokemon['image_path']) ?>" alt="<?= htmlspecialchars($pokemon['name']) ?>">

<?php if(!$pokemon['caught']): ?>
<form method="POST" action="catch.php">
<input type="hidden" name="id" value="<?= $pokemon['id'] ?>">
<button type="submit" name="ball" value="normal" class="catch normal">Pokéball 🎯 (50%)</button>
<button type="submit" name="ball" value="super" class="catch super">Superball 💥 (75%)</button>
<button type="submit" name="ball" value="ultra" class="catch ultra">Ultraball 🌟 (90%)</button>
</form>
<?php else: ?>
<p>✅ Gevangen!</p>
<?php endif; ?>
</div>

</body>
</html>