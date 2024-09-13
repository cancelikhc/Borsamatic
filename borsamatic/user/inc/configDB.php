<?php
// Veritabanı bağlantısı için gerekli bilgiler
$dbHost = 'localhost';
$dbName = 'borsamatic';
$dbUser = 'root';
$dbPass = '';

// Veritabanı bağlantısını oluştur
try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit;
}


?>
