<?php
include '../lib/koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tbmassages WHERE id = ?");
$stmt->execute([$id]);

header("Location: blank.php");
?>