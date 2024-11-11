<?php 
session_start();
if (isset($_SESSION['user_id'])) { // Cek apakah iduser ada di sesi
    session_destroy(); // Hapus sesi
}
header('Location: login.php'); // Arahkan kembali ke halaman login setelah logout
exit();
?>