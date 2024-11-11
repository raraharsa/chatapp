<?php
session_start(); // Pastikan session dimulai

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Chat</title>
    <style>
    /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.btn {
    background-color: #99A98F;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    height: 100vh;
    background-color: #C1D0B5; /* Background putih lembut */
}

header {
    background-color: #99A98F; /* Biru navy untuk header */
    color: #ffffff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

header h1 {
    margin: 0;
    font-size: 24px;
}

.buttons {
    display: flex;
    gap: 10px;
}

.buttons button {
    padding: 8px 12px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    color: #ffffff;
    background-color: #D6E8DB; /* Biru navy yang lebih terang untuk tombol */
}

.container {
    display: flex;
    flex: 1;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 250px;
    background-color: #99A98F; /* Background sidebar biru navy */
    overflow-y: auto;
    border-right: 1px solid #294e72;
    box-shadow: 4px 0px 8px rgba(0, 0, 0, 0.1);
}

.sidebar h3 {
    margin: 0;
    padding: 15px;
    background-color: #99A98F; /* Header sidebar biru navy yang lebih terang */
    color: #ffffff;
    font-size: 18px;
    text-align: center;
}

#kontakList {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#kontakList li {
    padding: 12px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#kontakList li:hover {
    background-color: #3b5b82; /* Hover efek biru navy yang lebih terang */
    color: #ffffff;
}

.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: #ffffff;
}

.chat-box {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background-color: #f5f5f5; /* Chat box putih lembut */
}

.message {
    margin: 8px 0;
    padding: 10px 15px;
    background-color: #e9eef2; /* Bubble chat putih keabuan */
    border-radius: 15px;
    max-width: 70%;
    position: relative;
}

.chat-input {
    display: flex;
    padding: 10px;
    border-top: 1px solid #294e72;
    background-color: #f5f5f5;
}

.chat-input input {
    flex: 1;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #d1d5da;
    border-radius: 8px;
    background-color: #ffffff;
}

.chat-input button {
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    border-radius: 8px;
    margin-left: 10px;
    color: #ffffff;
    background-color: #294e72; /* Tombol chat input biru navy */
}

</style>


</head>
<body>
<header>
<h1>𝕖𝕞𝕠𝕔𝕙𝕒𝕥</h1>
    <div class="buttons">
        <a href="modul/chat.php"><button class="text-dark">Tambah Kategori | chat</button></a>
        <button><a href="?page=logout" style="text-decoration: none; color: black;">Log Out</a></button>
    </div>
</header>

<div class="container">
        <div class="sidebar"> 
        
                <div class="list-group">
                        <h6 class=" p-2 text-light ">𝖳𝗈𝗉𝗂𝗄 𝖢𝗁𝖺𝗍</h6>
                            <?php
                            $stmt = $pdo->query("SELECT * FROM tbchats");
                            while($chat = $stmt->fetch()) {
                                echo "<a href='?chat_id=".$chat['id']."' class='list-group-item list-group-item-action'>".$chat['chat_name']."</a>";
                            }
                            ?>
                </div>
            </div>

       

   
        <!-- Chat Area -->
        <div class="col-md-9">
            <?php if(isset($_GET['chat_id'])): ?>
            <div class="p-3">
                <div class="messages-container" style="height: 70vh; overflow-y: auto;">
                    <?php
                    $stmt = $pdo->prepare("
                         SELECT 
            tbmassages.*, 
            tbusers.username,
            DATE_FORMAT(tbmassages.created_at, '%H:%i, %d %M %Y') as formatted_time 
        FROM tbmassages 
        JOIN tbusers ON tbmassages.user_id = tbusers.id 
        WHERE chat_id = ? 
        ORDER BY created_at
                    ");
                    $stmt->execute([$_GET['chat_id']]);
                    while($message = $stmt->fetch()) {
                        $isOwn = $message['user_id'] == $_SESSION['user_id'];
                        ?>
                        <div class="message-wrapper <?php echo $isOwn ? 'text-end' : 'text-start'; ?> mb-3">
                            <div class="message-bubble <?php echo $isOwn ? 'bg-sender text-dark' : 'bg-light'; ?> p-2 d-inline-block rounded">
                                <div class="message-header">
                                    <strong><?php echo $message['username']; ?> ⋆˚｡⋆</strong>
                                </div>
                                <div class="message-content">
                                    <?php echo $message['message']; ?>
                                </div>
                                <div class="message-footer">
                                    <i><small class="text-muted"><?php echo $message['formatted_time']; ?></small></i>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <form action="modul/message.php" method="POST" class="mt-3">
                    <input type="hidden" name="chat_id" value="<?php echo $_GET['chat_id']; ?>">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Kirim Pesan...">
                        <button type="submit" class="btn  bg-butt">Kirim</button>
                    </div>
                </form>
            </div>
            <?php else: ?>
            <div class="p-3 text-center mt-5 pt-5 text-secondary">
                <h3>Hai  <?=$username?> , Pilih Topik Chat Dahulu Ya!</h3>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>

<script>
// let selectedChatId = null;

// function pilihKontak(id, chat_name) {
//     selectedChatId = id;
//     document.getElementById('chatBox').innerHTML = `<div class="message"><em>Mulai chat dengan ${chat_name}</em></div>`;
//     loadMessages();
// }

// function loadMessages() {
//     if (!selectedChatId) return;

//     fetch(`loadmes.php?chat_id=${selectedChatId}`)
//         .then(response => response.json())
//         .then(data => {
//             const chatBox = document.getElementById('chatBox');
//             chatBox.innerHTML = '';  // Clear previous messages

//             if (data.error) {
//                 alert(data.error);
//                 return;
//             }

//             data.messages.forEach(message => {
//                 chatBox.innerHTML += `<div class="message">${message.message}</div>`;
//             });
//         })
//         .catch(error => {
//             alert('Terjadi kesalahan saat memuat pesan!');
//             console.error(error);  // Debugging
//         });
// }

// function kirimPesan() {
//     const pesan = document.getElementById('inputPesan').value.trim();
//     if (!selectedChatId || pesan === '') {
//         alert('Pilih kategori dan ketik pesan!');
//         return;
//     }

//     const formData = new FormData();
//     formData.append('chat_id', selectedChatId);
//     formData.append('message', pesan);

//     fetch('sendmes.php', {
//         method: 'POST',
//         body: formData
//     })
    // .then(response => response.json())
    // .then(data => {
    //     if (data.success) {
    //         const chatBox = document.getElementById('chatBox');
    //         chatBox.innerHTML += `<div class="message">${pesan}</div>`;
    //         document.getElementById('inputPesan').value = '';  // Clear input field
    //         loadMessages();  // Refresh messages after sending
    //     } else {
    //         alert('Error: ' + data.error);
    //     }
    // })
    // .catch(error => {
    //     console.error('Error sending message:', error);
    //     alert('Terjadi kesalahan saat mengirim pesan!');
    // });
// }
</script>

</body>
</html>
