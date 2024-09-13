<?php
// Oturum kontrolü
session_start();
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmadıysa, giriş sayfasına yönlendir
    header('Location: girisYap.php');
    exit;
}

// Hoş geldiniz mesajı için kullanıcı adını al
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoş Geldiniz</title>
</head>
<body>
    <h2>Hoş Geldiniz, <?php echo $username; ?>!</h2>
    <p>Bu, hoş geldiniz sayfasıdır. Kullanıcı girişi başarılı oldu!</p>
    <p><a href="cikisYap.php">Çıkış Yap</a></p>
</body>
</html>
