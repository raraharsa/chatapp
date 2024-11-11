
<?php
session_start();

include "lib/koneksi.php";
if (!isset($_SESSION['user_id'])) {
    include "login.php";
}else {
    $sqlUser  = $pdo->prepare("SELECT * FROM tbusers WHERE id = ?");
    $sqlUser ->execute([$_SESSION['user_id']]);
   
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Chat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
$page = ($_GET['page'])?$_GET['page']:null;
if (isset($page)){
  if ($page=='logout') {
    include "modul/logout.php";
  }

  
} else{
    include "modul/default.php";
  }

?>
</body>

</html>
<?php
}
?>
