<?php
include '../lib/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat_name = $_POST['chat_name'];

    $stmt = $pdo->prepare("INSERT INTO tbchats (id,chat_name) VALUES (?, ?)");
    $stmt->execute([$chat_name]);

    header("Location: re_chat.php");
}
?>

  
