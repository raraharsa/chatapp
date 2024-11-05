<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f3f4f6;
        }
        header {
            background-color: #546e7a;
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
            font-weight: bold;
            letter-spacing: 1px;
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
            background-color: #4db6ac;
            transition: background-color 0.3s ease;
        }
        .buttons button:hover {
            background-color: #00897b;
        }
        .container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #eeeeee;
            overflow-y: auto;
            border-right: 1px solid #ddd;
            box-shadow: 4px 0px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar h3 {
            margin: 0;
            padding: 15px;
            background-color: #4db6ac;
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
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #kontakList li:hover {
            background-color: #f0f4c3;
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
            background-color: #f9f9f9;
        }
        .message {
            margin: 8px 0;
            padding: 10px 15px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 70%;
            position: relative;
            font-size: 15px;
        }
        .message::after {
            content: "";
            position: absolute;
            top: 10px;
            left: -8px;
            border: 8px solid transparent;
            border-right-color: #ffffff;
        }
        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: #eeeeee;
        }
        .chat-input input {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
        }
        .chat-input button {
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            margin-left: 10px;
            color: #ffffff;
            background-color: #4db6ac;
            transition: background-color 0.3s ease;
        }
        .chat-input button:hover {
            background-color: #00897b;
        }
    </style>
</head>
<body>

<header>
    <h1>Chat App</h1>
    <div class="buttons">
        <button onclick="tambahGrup()">Tambah Grup</button>
        <button onclick="tambahKontak()">Tambah Kontak</button>
    </div>
</header>

<div class="container">
    <div class="sidebar">
        <h3>Member</h3>
        <ul id="kontakList">
            <li>Kontak 1</li>
            <li>Kontak 2</li>
        </ul>
    </div>
    <div class="chat-area">
        <div class="chat-box" id="chatBox">
            <div class="message">Selamat datang di chat!</div>
        </div>
        <div class="chat-input">
            <input type="text" id="inputPesan" placeholder="Ketik pesan...">
            <button onclick="kirimPesan()">Kirim</button>
        </div>
    </div>
</div>

<script>
    function tambahGrup() {
        let namaGrup = prompt("Masukkan nama grup:");
        if (namaGrup) {
            let list = document.getElementById("kontakList");
            let item = document.createElement("li");
            item.textContent = namaGrup;
            list.appendChild(item);
        }
    }

    function tambahKontak() {
        let namaKontak = prompt("Masukkan nama kontak:");
        if (namaKontak) {
            let list = document.getElementById("kontakList");
            let item = document.createElement("li");
            item.textContent = namaKontak;
            list.appendChild(item);
        }
    }

    function kirimPesan() {
        let input = document.getElementById("inputPesan");
        let pesan = input.value;
        if (pesan.trim() !== "") {
            let chatBox = document.getElementById("chatBox");
            let message = document.createElement("div");
            message.className = "message";
            message.textContent = pesan;
            chatBox.appendChild(message);
            input.value = "";
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
</script>

</body>
</html>
