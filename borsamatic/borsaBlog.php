<?php $page = 'borsaBlog'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/menu.php'; ?>
</head>
<body>
    <center>
        <br>
        <h1 class="lacivert-yazi">SON DAKİKA!</h1> <h1 class="yesil-yazi">GÜNDEM YORUMLARI</h1>
        <br>
    </center>

    <div class="container">

        <div class="row">
        <?php
        include_once 'function/function.php';
        $database = new Database();
$db = $database->connect();
if ($db) {
    try {
        // Makaleleri çek
        $sql = "SELECT * FROM borsablog"; // Örneğin, oluşturulma tarihine göre sıralayabilirsiniz
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $makaleler = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($makaleler) {
            foreach ($makaleler as $makale) {
                echo '
                <div class="col-4">
                <div class="card" style="width: 22rem;">
                <img src="'.$makale['makaleResim'].'" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">'.$makale['makaleBaslik'].'</h5>
                <p class="card-text">'.$makale['makaleOzet'].'</p>
                <a href="makaleGoruntule.php?id='.$makale['id'].'" class="btn btn-primary">Yazıyı Oku</a>
            </div>
            </div>
                <br>
                <br>
                </div>

                ';
            }
        } else {
            echo "Hiç makale bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "Sorgu hatası: " . $e->getMessage();
    }
} else {
    echo "Bağlantı hatası!";
}
?>
        </div>

    </div>

</body>
<?php include 'inc/footer.php'; ?>
</html>


