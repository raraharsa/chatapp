<?php 
include '../lib/koneksi.php';

// Ambil data chat dan user
$stmt = $pdo->query("SELECT * FROM tbchats");
$chats = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM tbusers");
$users = $stmt->fetchAll();

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat_id = $_POST['chat_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    // Validasi input
    if (!empty($chat_id) && !empty($user_id) && !empty($message)) {
        // Insert pesan ke database
        $stmt = $pdo->prepare("INSERT INTO tbmassages (chat_id, user_id, message) VALUES (?, ?, ?)");
        $stmt->execute([$chat_id, $user_id, $message]);

        // Redirect ke halaman pesan yang sesuai dengan chat_id
        header("Location: remes.php?chat_id=$chat_id");
        exit;
    } else {
        
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pesan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C1D0B5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #99A98F;
            border-radius: 4px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #99A98F;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #7f8f6f;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

    </style>
</head>
<body>

    <form method="POST">
        <h2>Kirim Pesan</h2>

        <label for="chat_id">Topik Chat:</label>
        <select name="chat_id" id="chat_id" required>
            <?php foreach ($chats as $chat): ?>
                <option value="<?= $chat['id'] ?>"><?= $chat['chat_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>

        <button type="submit">Kirim</button>
    </form>

</body>
</html>
