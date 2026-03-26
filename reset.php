<?php
include 'db.php';

$pdo->query("UPDATE pokemon SET caught = 0");

header("Location: index.php");
exit;