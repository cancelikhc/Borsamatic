<?php $page = 'borsaBlog'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/menu.php'; ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
            <?php
include_once 'function/function.php';
$database = new Database();
$db = $database->connect();
if ($db) {
    try {
        // Makale içeriğini çek
        $makale_id = $_GET['id']; // İçeriğini çekmek istediğiniz makalenin ID'si
        $sql = "SELECT * FROM borsablog WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $makale_id);
        $stmt->execute();
        $makale = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($makale) {
            $username = $makale['makaleYazar'];
            echo '
            <br>
            <div class="card mb-3">
            <img src="'.$makale['makaleResim'].'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.$makale['makaleBaslik'].'</h5>
              <p class="card-text">'.$makale['makaleIcerik'].'</p>
              <p class="card-text"><small class="text-muted">'.$makale['makaleTarih'].'</small>&nbsp;-&nbsp;<small class="text-muted">'.$makale['makaleYazar'].'</small></p>

            </div>
          </div>
            ';

            
        } else {
            echo "Belirtilen ID'ye sahip makale bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "Sorgu hatası: " . $e->getMessage();
    }
} else {
    echo "Bağlantı hatası!";
}
?>
            </div>
            <div class="col-12 col-md-4">
                <br>
                <div class="sidebar">
                    <span class="baslikBorderBottom" style="font-size:24px">Yazar</span>
                    <br>
                    <br>
                    <center>

                    <?php
include_once 'function/function.php';
$database = new Database();
$db = $database->connect();
if ($db) {
    try {
        // Kullanıcı adı belirli olan kullanıcıyı çek
         // Çekmek istediğiniz kullanıcının kullanıcı adı
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            echo '<img src="'.$user['img'].'" class="img-fluid rounded-circle" height="100px" width="100px">
            ';
            echo '<br>';
            echo '<span class="" style="font-size:16px">'.$user['ad'].'&nbsp;'.$user['soyad'].'</span>';
            // Diğer kullanıcı bilgilerini istediğiniz gibi buraya ekleyebilirsiniz
        } else {
            echo "Belirtilen kullanıcı adına sahip kullanıcı bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "Sorgu hatası: " . $e->getMessage();
    }
} else {
    echo "Bağlantı hatası!";
}
?>


                    <br>
                    
                    </center>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include 'inc/footer.php'; ?>
</html>

