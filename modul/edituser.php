<?php
include '../lib/koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tbusers WHERE id = ?");
$stmt->execute([$id]);
$chats = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];

    // Perbaikan query SQL
    $stmt = $pdo->prepare("UPDATE tbusers SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$user, $email, $id]);

    header("Location: reuser.php");
    exit; // Tambahkan exit untuk menghentikan eksekusi setelah redirect
}
?>
 
<form method="POST">
    username: <input type="text" name="username" value="<?= htmlspecialchars($chats['username']) ?>" required>
    email: <input type="text" name="email" value="<?= htmlspecialchars($chats['email']) ?>" required>
    <button type="submit">Update</button>
</form>
