<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include "lib/koneksi.php";

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['id'])) {
    // Alihkan pengguna ke halaman login
    header("Location: login.php");
    exit;
} else {
    // Mendapatkan data pengguna dari database berdasarkan session ID
    $stmt = $pdo->prepare("SELECT * FROM tbusers WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['id']]);
    $resultuser = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Chat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Konten dashboard chat akan ditambahkan di sini -->

</body>
</html>
<?php 
} 
?>
