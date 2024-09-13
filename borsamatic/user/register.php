<?php
session_start();
// Eğer kullanıcı zaten oturum açtıysa, welcome.php'ye yönlendir
if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}
// Veritabanı bağlantısı
$dsn = "mysql:host=localhost;dbname=borsamatic;charset=utf8mb4";
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // Hata modunu ayarla, gerçek uygulamada geliştirme aşamasında kullan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}

// Kullanıcı kaydını işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];
    $kullanici_adi = $_POST["kullanici_adi"];

    // E-posta adresi, kullanıcı adı veya e-posta daha önce kullanılmış mı kontrol et
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE mail = :email OR username = :kullanici_adi");
    $stmt->execute(['email' => $email, 'kullanici_adi' => $kullanici_adi]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $basarisiz = "Bu e-posta adresi veya kullanıcı adı zaten kullanımda.";
        echo "<script type='text/javascript'>alert('$basarisiz');</script>";
    } else {
        // Eğer e-posta adresi ve kullanıcı adı kullanılmamışsa, kullanıcıyı ekleyelim
        $stmt = $pdo->prepare("INSERT INTO users (ad, soyad, mail, password, username) VALUES (:ad, :soyad, :email, :sifre, :kullanici_adi)");
        $stmt->execute(['ad' => $ad, 'soyad' => $soyad, 'email' => $email, 'sifre' => $sifre, 'kullanici_adi' => $kullanici_adi]);
        $basarili = "Üye kaydınız başarıyla oluşturuldu.";
        echo "<script type='text/javascript'>alert('$basarili');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Zenix -  Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<img src="../img/logo.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Yeni Hesap Oluştur</h4>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Ad</strong></label>
                                            <input type="text" name="ad" class="form-control" placeholder="Ad">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Soyad</strong></label>
                                            <input type="text" name="soyad" class="form-control" placeholder="Soyad">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>E-Posta</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Kullanıcı Adı</strong></label>
                                            <input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Parola</strong></label>
                                            <input type="password" name="sifre" class="form-control" placeholder="Parola">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Zaten hesabın var mı? <a class="text-primary" href="login.php">Giriş Yap</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./js/deznav-init.js"></script>


</body>
</html>