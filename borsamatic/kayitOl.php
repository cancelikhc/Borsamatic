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
<html lang="tr">
<head>
<?php include 'inc/header.php'; ?>
<link rel="stylesheet" href="css/kayitol.css" /> 
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
  <?php include 'inc/menu.php'; ?>
</head>
<body>
    <br>
<section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Kayıt Ol</h2>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="ad" id="ad" placeholder="Ad"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="soyad" id="soyad" placeholder="Soyad"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="kullanici_adi" id="kullanici_adi" placeholder="Kullanıcı Adı"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="E-Posta"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="sifre" id="sifre" placeholder="Parola"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Tüm şartları kabul ediyorum.  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Kayıt Ol"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">Zaten Üye misin ? Giriş Yap</a>
                    </div>
                </div>
            </div>
        </section>
</body>
<script src="js/kayitol.js"></script>

<?php include 'inc/footer.php'; ?>
</html>