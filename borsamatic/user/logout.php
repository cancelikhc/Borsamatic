<?php
// Oturumu sonlandır
session_start();
session_unset();
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header('Location: login.php');
exit;
?>
