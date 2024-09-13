<?php
session_start();
// Eğer kullanıcı zaten oturum açtıysa, welcome.php'ye yönlendir
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
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
        header('Location: login.php');
        exit;
    } else {
        // Giriş başarısız
        $error = "Kullanıcı adı/e-posta veya şifre yanlış!";
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
<?php if(isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
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
                                    <h4 class="text-center mb-4">Giriş Yap</h4>
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>E-Posta veya Kullanıcı Adı</strong></label>
                                            <input type="text" name="username_or_email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Parola</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            
                                           
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Hesabınız yok mu? <a class="text-primary" href="register.php">Kayıt Ol</a></p>
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