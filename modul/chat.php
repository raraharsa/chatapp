<?php
include '../lib/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kate = $_POST['kate'];

    // Perbaiki pernyataan SQL dan gunakan satu placeholder saja
    $stmt = $pdo->prepare("INSERT INTO tbchats (chat_name) VALUES (?)");
    $stmt->execute([$kate]);

    // Redirect setelah penyimpanan berhasil
    header("Location: rechat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kategori</title>
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
        form {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #99A98F;
            border-radius: 4px;
            margin-left: -9px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #99A98F;
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        button[type="submit"]:hover {
            background-color: #7f8f6f;
        }
    </style>
</head>
<body>

    <form method="POST">
        <label for="kate">Buat Topik:</label>
        <input type="text" name="kate" id="kate" required>
        <button type="submit">Simpan</button>
    </form>

</body>
</html>
