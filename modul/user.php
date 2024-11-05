//<?php
require '../lib/koneksi.php'; // Pastikan file koneksi tersedia di direktori yang benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Cek apakah username atau email sudah terdaftar
    $stmt = $pdo->prepare("SELECT * FROM tbusers WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $userExists = $stmt->fetch();

    if ($userExists) {
        $error_message = "Username atau email sudah terdaftar!";
    } else {
        // Masukkan data ke tabel tbusers
        $stmt = $pdo->prepare("INSERT INTO tbusers (username, email) VALUES (?, ?)");
        $stmt->execute([$username, $email]);
        header("Location: login.php"); // Alihkan ke halaman login setelah pendaftaran
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .create-container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="create-container">
    <h2 class="text-center">Create User</h2>
    <form method="POST">
        <div class="form-outline mb-4">
            <label class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" required />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" required />
        </div>
        
        <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <p>Sudah punya akun? <a href="index.php" class="btn btn-link">Login</a></p>
        </div>
    </form>
</div>

</body>
</html>
