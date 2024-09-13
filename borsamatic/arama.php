<?php
 
// Veritabanı ayarlama
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'borsamatic';
 
// Veritabanına bağlan
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
 
// GET isteğinden terimi al
$arananTerim = $_GET['term'];
 
// eşleşen kayıtları seç
$query = $db->query("SELECT * FROM uygunendeks WHERE hisseKodu LIKE '%".$arananTerim."%' ORDER BY id ASC");
 
// Diller listesini oluştur
$dilData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['hisseKodu'];
        array_push($dilData, $data);
    }
}
 
// JSON verisine çevir
echo json_encode($dilData);