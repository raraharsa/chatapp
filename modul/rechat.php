<?php
include '../lib/koneksi.php';

$stmt = $pdo->query("SELECT * FROM tbchats");
$chats = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #99A98F;
        }

        th {
            background-color: #99A98F;
            color: #FFFFFF;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: #99A98F;
            color: white;
            border-radius: 4px;
            margin: 0 5px;
        }

        a:hover {
            background-color: #7f8f6f;
        }

    </style>
</head>
<body>

    <table>
        <tr>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($chats as $chat): ?>
            <tr>
                <td><?= htmlspecialchars($chat['chat_name']) ?></td>
                <td>
                    <a href="editchat.php?id=<?= $chat['id'] ?>">Edit</a>
                    <a href="delchat.php?id=<?= $chat['id'] ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        
    </table>
    
</body>
</html>
