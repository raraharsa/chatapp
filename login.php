<?php
session_start();
include "lib/koneksi.php"; // Pastikan koneksi tersedia di sini

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Query untuk mengecek username dan email
    $stmt = $pdo->prepare("SELECT * FROM tbusers WHERE username = :username AND email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $resultuser = $stmt->fetch();

    if ($resultuser) {
        $_SESSION['user_id'] = $resultuser['id']; // Simpan ID pengguna di session
        header('Location: modul/default.php'); // Alihkan ke dashboard
        exit;
    } else {
        $error_message = "Login gagal! Username atau email salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
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

<div class="login-container">
    <h2 class="text-center">Login</h2>
    <form method="POST">
        <div class="form-outline mb-4">
            <label class="form-label">Masukkan Username:</label>
            <input type="text" class="form-control" name="username" required />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Masukkan Email:</label>
            <input type="email" class="form-control" name="email" required />
        </div>
        
        <button type="submit" class="btn btn-primary btn-block mb-4" name="btn">Login</button>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
            <div class="text-center">
                <p>Belum punya akun? <a href="modul/user.php" class="btn btn-link">Daftar Akun</a></p>
            </div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
