<?php
date_default_timezone_set('Europe/Istanbul');
setlocale(LC_TIME, 'tr_TR');
$gunler = array(
    'Pazartesi',
    'Salı',
    'Çarşamba',
    'Perşembe',
    'Cuma',
    'Cumartesi',
    'Pazar'
);
 
$aylar = array(
    'Ocak',
    'Şubat',
    'Mart',
    'Nisan',
    'Mayıs',
    'Haziran',
    'Temmuz',
    'Ağustos',
    'Eylül',
    'Ekim',
    'Kasım',
    'Aralık'
);
 
$ay = $aylar[date('m') - 1];
$gun = $gunler[date('N') - 1];
?>

<?php include 'configDB.php'; ?>
<!--**********************************
            Sidebar start
        ***********************************-->

        <?php
            // Tekil bir kullanıcıyı çekmek için sorgu hazırla ve çalıştır
 // veya $_POST veya $_GET gibi bir girişten alabilirsiniz
$query = "SELECT * FROM users WHERE username = :username";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

        ?>
        
        <div class="deznav">
            <div class="deznav-scroll">
				<div class="main-profile">
					<img src="<?php echo $user['img']; ?>" alt="">
					<h5 class="mb-0 fs-20 text-black "><span class="font-w400">Hoşgeldin,</span> <?php echo $user['ad']; ?>&nbsp;<?php echo $user['soyad']; ?> </h5>
					<p class="mb-0 fs-14 font-w400"><div id="zaman" class="text-white"></div></p>
				</div>
				<ul class="metismenu" id="menu">
                <li><a href="index.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-home"></i>
							<span class="nav-text">Ana Sayfa</span>
						</a>
				</li>
                <li><a href="hisseler.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-044-file"></i>
							<span class="nav-text">Hisseler</span>
						</a>
				</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notebook"></i>
							<span class="nav-text">Akademi</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="egitimler.php">Eğitimler</a></li>
                            <li><a href="index.html">Yazılar</a></li>
                            <li><a href="index.html">Webinarlar</a></li>
						</ul>

                    </li>
                </ul>
				<div class="copyright">
					<p><strong>Zenix Crypto Admin Dashboard</strong> © 2021 All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by DexignZone</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

<script>
function tarihSaat() {
    var date = new Date().toLocaleString('tr-TR');
    document.getElementById("zaman").innerHTML = date;
}
// her 1 saniyede tarihSaat fonksiyonunu yeniden çalıştır
setInterval(tarihSaat, 1000); 
</script> 