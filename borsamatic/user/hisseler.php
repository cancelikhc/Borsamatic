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
				<div class="form-head mb-4 mb-sm-5 d-flex  flex-wrap align-items-center ">
					<h2 class="font-w600 mb-0 mr-auto">Hisseler</h2>
					</div>
				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive table-hover fs-14 ">
							<table class="table display mb-4 dataTablesCard font-w600  border-no card-table text-black" id="example6">
								<thead>
									<tr>
										<th>Hisse Kodu</th>
										<th>Son Fiyat</th>
										<th>Hacim</th>
										
									</tr>
								</thead>
								<tbody>

								<?php
                 foreach($dec['result'] as $k => $v){
                    echo '<tr><td class="wspace-no"><span class="text-black"><a href="hisse.php?name='.$v['code'].'">'.$v['code'].'</a></span><br><span class="sirketAdi">'.$v['text'].'</span></td><td>'.$v['lastpricestr'].'</td><td>'.$v['hacimstr'].'</td></tr>';
                }
            ?>


									
								</tbody>
							</table>	
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