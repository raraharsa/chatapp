<?php
include '../lib/koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tbusers WHERE id = ?");
$stmt->execute([$id]);

header("Location: reuser.php");
?>