<?php $page = 'guncelKatilimEndeksi'; ?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <?php include 'inc/header.php'; ?>
  <?php include 'inc/menu.php'; ?>
</head>
<body>
    <center>
        <br>
        <h1 class="lacivert-yazi">2024 GÜNCEL </h1> <h1 class="yesil-yazi">ENDEKSE UYGUN HİSSELER</h1>
        <br>
    </center>
        <div class="container">
        <div class="endeksTablo">
        <table class="table table-striped table-hover">
        <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Hisse Kodu</th>
      <th scope="col">Hisse Adı</th>
      <th scope="col">Uygunluk</th>
    </tr>
  </thead>
  <tbody>
  <?php
include_once 'function/function.php';
$database = new Database();
$db = $database->connect();
if ($db) {
    try {
        // Örnek bir sorgu: Tüm kullanıcıları seç
        $sql = "SELECT * FROM uygunendeks";
        // Sorguyu hazırla ve çalıştır
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // Sonuçları al
        $uygunHisseler = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Sonuçları işle
        if ($uygunHisseler) {
            foreach ($uygunHisseler as $uh) {
                echo '<tr>
                <th scope="row">'.$uh['id'].'</th>
                <td>'.$uh['hisseKodu'].'</td>
                <td>'.$uh['hisseAdi'].'</td>
                <td><span class="badge bg-success">Uygun Endeks</span></td>
              </tr>';
            }
        } else {
            echo "Hiç kullanıcı bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "Sorgu hatası: " . $e->getMessage();
    }
} else {
    echo "Bağlantı hatası!";
}
?>
  </tbody>
        </table>
        </div>
    </div>
</body>
<?php include 'inc/footer.php'; ?>
</html>






