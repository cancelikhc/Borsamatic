
<?php
session_start();
// Eğer kullanıcı zaten oturum açtıysa, welcome.php'ye yönlendir
if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}
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

// Giriş formu gönderildiğinde
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Kullanıcı adı veya e-posta ile giriş yap
    $query = "SELECT * FROM users WHERE (username = :username OR mail = :email) AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $usernameOrEmail);
    $stmt->bindParam(':email', $usernameOrEmail);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kullanıcı varsa oturum başlat
    if($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Giriş başarılı, yönlendirme yapabilirsiniz
        header('Location: welcome.php');
        exit;
    } else {
        // Giriş başarısız
        $error = "Kullanıcı adı/e-posta veya şifre yanlış!";
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
                        <h2 class="form-title">Giriş Yap</h2>
                        <form method="POST" action="" class="register-form" id="register-form">

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_or_email" id="username_or_email" placeholder="Kullanıcı Adı veya E-Posta" required/>
                            </div>

                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Parola" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Giriş Yap"/>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
</body>
<script src="js/kayitol.js"></script>

<?php include 'inc/footer.php'; ?>
</html>