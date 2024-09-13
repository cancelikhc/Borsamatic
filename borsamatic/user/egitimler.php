<?php
// Oturum kontrolü
session_start();
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmadıysa, giriş sayfasına yönlendir
    header('Location: login.php');
    exit;
}

// Hoş geldiniz mesajı için kullanıcı adını al
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'inc/meta.php'; ?>
<title>Zenix - Crypto Admin Dashboard </title>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        
		
		<?php include 'inc/menuNavHeader.php'; ?>
		<?php include 'inc/menuChatbox.php'; ?>
		<?php include 'inc/menuHeader.php'; ?>
		<?php include 'inc/menuSidebar.php'; ?>
        <?php include 'inc/hisseSenedi.php'; ?>
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">
				<div class="form-head mb-4  d-flex  flex-wrap align-items-center ">
					
					</div>
				<div class="row">


					<div class="col-xl-8">
                    <h2 class="font-w600 mb-0 mr-auto">Hisseler</h2>
                    <br>
                        <div class="row">
                            <?php
                                try {
                                    // Sorguyu hazırla ve çalıştır
                                    $query = "SELECT * FROM egitimler ORDER BY id DESC";
                                    $statement = $db->prepare($query);
                                    $statement->execute();
                                    
                                    // Sonuçları al ve işle
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    // Sonuçları ekrana yazdır
                                    foreach ($results as $row) {
                                        echo '
                                        <div class="col-lg-12">
                                <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">'.$row['egitimismi'].'</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-white">'.$row['egitimaciklama'].'</p>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-between align-items-center">
                                <div class="card-footer-link mb-4 mb-sm-0">
                                    <p class="card-text d-inline text-white">'.$row['egitimyazar'].'</p>
                                </div>

                                <a href="egitim.php?id='.$row['id'].'" class="btn btn-primary">Eğitime Git</a>
                            </div>
                        </div>
                            </div>
                            <br>
                                        ';
                                    }
                                } catch(PDOException $e) {
                                    // Hata durumunda hata mesajını yazdır
                                    echo "Sorgu hatası: " . $e->getMessage();
                                }
                            ?>

                         
                            
                            
                            
                            
                        </div>
					</div>

                    <div class="col-xl-4">
                    <h2 class="font-w600 mb-0 mr-auto">Yazılar</h2>
                    <br>
                        <div class="row">
                        <?php
                                try {
                                    // Sorguyu hazırla ve çalıştır
                                    $query = "SELECT * FROM borsablog ORDER BY id DESC LIMIT 3";
                                    $statement = $db->prepare($query);
                                    $statement->execute();
                                    
                                    // Sonuçları al ve işle
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    // Sonuçları ekrana yazdır
                                    foreach ($results as $row) {
                                        echo '
                                        <div class="col-lg-12">
                                <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><img src="'.$row['makaleResim'].'" class="img-fluid"><br><br>'.$row['makaleBaslik'].'</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-white">'.$row['makaleOzet'].'</p>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-between align-items-center">
                                <div class="card-footer-link mb-4 mb-sm-0">
                                    <p class="card-text d-inline text-white">'.$row['makaleYazar'].'</p>
                                </div>

                                <a href="../makaleGoruntule.php?id='.$row['id'].'" target="_blank" class="btn btn-primary">Yazıya Git</a>
                            </div>
                        </div>
                            </div>
                            <br>
                                        ';
                                    }
                                } catch(PDOException $e) {
                                    // Hata durumunda hata mesajını yazdır
                                    echo "Sorgu hatası: " . $e->getMessage();
                                }
                            ?> 
                    </div>
                        </div>
				</div>
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include 'inc/footer.php'; ?>
        <!--**********************************
            Footer end
        ***********************************-->
		
		
		
		
		
		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="./vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="./js/dashboard/market-capital.js"></script>
	<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/plugins-init/chartjs-init.js"></script>
	<?php 

	?>
	<!-- Dashboard 1 -->
	<script src="./js/dashboard/dashboard-1.js"></script>
	
	<script src="./vendor/owl-carousel/owl.carousel.js"></script>
    <script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>
    
    

</body>
</html>