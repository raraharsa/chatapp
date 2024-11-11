<?php
include '../lib/koneksi.php';

$chat_id = $_GET['chat_id'];

// Mengambil pesan berdasarkan chat_id
$stmt = $pdo->prepare("SELECT * FROM tbmassages WHERE chat_id = ?");
$stmt->execute([$chat_id]);
$messages = $stmt->fetchAll();

// Mengambil daftar chat untuk opsi chat_id
$chats_stmt = $pdo->query("SELECT id, chat_name FROM tbchats");
$chats = $chats_stmt->fetchAll();

// Mengambil daftar pengguna untuk opsi user_id
$users_stmt = $pdo->query("SELECT id, username FROM tbusers");
$users = $users_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Chat</title>
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
            width: 100%;
            border-collapse: collapse;
            background-color: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
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

        #messages {
            margin-top: 20px;
            width: 80%;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 8px;
            margin-bottom: 8px;
            background-color: #f9f9f9;
            border-left: 4px solid #99A98F;
        }
    </style>
</head>
<body>

    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= $message['id'] ?></td>
                        <td>
                            <?php
                            $user_stmt = $pdo->prepare("SELECT username FROM tbusers WHERE id = ?");
                            $user_stmt->execute([$message['user_id']]);
                            $user = $user_stmt->fetch();
                            echo $user['username'];
                            ?>
                        </td>
                        <td><?= $message['message'] ?></td>
                        <td><?= $message['created_at'] ?></td>
                        <td>
                            
                            <a href="delmes.php?id=<?= $message['id']?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       
    </div>

    <script>
    // Mengirim pesan ke server
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('sendmes.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                loadMessages();
                document.getElementById('message').value = ''; // Bersihkan input pesan
            } else {
                alert('Error: ' + data.error);
            }
        });
    });

    // Memuat pesan secara dinamis
    function loadMessages(){
        const chatId = document.getElementById('chat_id').value;

        fetch('loadmes.php?chat_id=' + chatId)
            .then(response => response.json())
            .then(data => {
                const messagesContainer = document.getElementById('messages');
                messagesContainer.innerHTML = ''; // Clear previous messages

                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(message => {
                        messagesContainer.innerHTML += `<div class="message">${message.username}: ${message.message}</div>`;
                    });
                } else {
                    messagesContainer.innerHTML = '<div>No messages found.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
    }

    loadMessages(); // Memuat pesan saat halaman pertama kali dimuat
    </script>

</body>
</html>
