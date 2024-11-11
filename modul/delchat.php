<?php
include '../lib/koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tbchats WHERE id = ?");
$stmt->execute([$id]);

header("Location: rechat.php");
?>