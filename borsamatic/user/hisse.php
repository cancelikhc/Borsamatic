
<?php
$name = $_GET['name'];
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

<?php include 'inc/hisseSayfasi.php'; ?>

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
					<h2 class="font-w600 mb-0 mr-auto"><?php echo $name; ?></h2>
					</div>
                    <div class="row">
					<div class="col-xl-9 col-xxl-8">
						<div class="card">
							<div class="card-header border-0 flex-wrap pb-0">
								<div class="mb-3">
									<h4 class="fs-20 text-black"><?php echo $name.' - '; ?> <?php foreach($dec['result'] as $k => $v){if($name == $v['code']){$found = true;$data = $v;echo $v['text'];}}?> - Son Dönem Performansı</h4>
								</div>
							</div>
							<div class="card-body pb-0">
							<canvas id="ilk"></canvas>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4">
						<div class="card">
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 text-black">İstatistikler</h4>
							</div>
							<div class="card-body pb-0">
								<div id="currentChart" class="current-chart"></div>
								<div class="chart-content">	
									<div class="d-flex justify-content-between mb-2 align-items-center">
										<div>
											<svg class="mr-2" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect width="15" height="15" rx="7.5" fill="#EB8153"/>
											</svg>
											<span class="fs-14">Değişim</span>
										</div>
										<div>
											<h5 class="mb-0"><?php foreach($lbdec['result'] as $k => $v){if($name == $v['name']){$found = true;$data = $v;echo $v['rate'].' %';}}?></h5>
										</div>
									</div>
									<div class="d-flex justify-content-between mb-2 align-items-center">
										<div>
											<svg class="mr-2" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect width="15" height="15" rx="7.5" fill="#71B945"/>
											</svg>

											<span class="fs-14">Son Fiyat</span>
										</div>
										<div>
											<h5 class="mb-0">₺<?php foreach($dec['result'] as $k => $v){if($name == $v['code']){$found = true;$data = $v;echo $v['lastpricestr'];}}?></h5>
										</div>
									</div>
									<div class="d-flex justify-content-between mb-2 align-items-center">
										<div>
											<svg class="mr-2" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect width="15" height="15" rx="7.5" fill="#4A8CDA"/>
											</svg>
											<span class="fs-14">Hacim</span>
										</div>
										<div>
											<h5 class="mb-0"><?php foreach($dec['result'] as $k => $v){if($name == $v['code']){$found = true;$data = $v;echo $v['hacimstr'];}}?></h5>
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
    
    <script>
        // JSON dosyasını okuma
        fetch('damla.json')
        .then(response => response.json())
        .then(data => {
            // Kullanıcı tarafından seçilen para birimi
            const currency = '<?php echo $name; ?>'; // Örneğin sadece dolar olarak aldım, dinamik olarak da alabilirsiniz

            // Grafiği oluşturma
            const ctx = document.getElementById('ilk').getContext('2d');
            const ctxgradientStroke = ctx.createLinearGradient(0, 1, 0, 500);
            ctxgradientStroke.addColorStop(0, "rgba(255, 62, 62, 0.2)");
			ctxgradientStroke.addColorStop(1, "rgba(255, 62, 62, 0)");
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data[currency].map(entry => new Date(entry.time * 1000).toLocaleString()),
                    datasets: [{
                        label: `${currency.toUpperCase()} Fiyatı`,
                        data: data[currency].map(entry => entry.price),
                        borderColor: "#ff2625",
						borderWidth: "4",
                        tension: 0.1,
                        backgroundColor: ctxgradientStroke
                    }]
                },

                options: {
                    legend: false, 
                    scales: {
                        x: {
                            
                            type: 'time',
                            time: {
                                unit: 'minute'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Fiyat'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>