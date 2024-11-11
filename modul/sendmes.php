<?php
session_start();
include "../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chat_id = $_POST['chat_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO tbmassages (chat_id, user_id, message) VALUES (?, ?, ?)");
    if($stmt->execute([$chat_id, $user_id, $message])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to send message']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}