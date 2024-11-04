<?php
$host = 'localhost';
$db = 'chat_app';
$user = 'root';
$pass = 'arin12345'; // Pertimbangkan untuk menggunakan variabel lingkungan untuk keamanan
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // Menggunakan DSN
    // Koneksi berhasil
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
