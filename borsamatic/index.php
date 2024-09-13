<?php $page = 'anaSayfa'; ?>

<!DOCTYPE html>
<html lang="en">
<head>  
   <style>
      body {
         background: url("img/bgg.jpg") !important;
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-attachment: fixed !important;
      }
      </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
  <?php include 'inc/header.php'; ?>
  <?php include 'inc/menu.php'; ?>
  <script>

         $(function(){
            $("#country").keyup(function(){
               var countryName = $(this).val();
               $.ajax({
                  method: "POST",
                  url: "getCountry.php",
                  data:{country:countryName}
               })
                  .done(function(data){
                  $("#suggestions").show();
                  $("#suggestions").html(data);
               });
            });
         });

      </script>
</head>
<body>




  <center>
    <h1 class="anasayfa-slogan1 lacivert-yazi">DETAYLI ANALİZ <br> </h1> <h1 class="yesil-yazi">DOĞRU KARAR!</h1>
    <p>Borsamatic ile hisse senedi analizinde yeni yaklaşımlar, kusursuz sonuç.</p>
    <div class="container">

            <div class="row height d-flex justify-content-center align-items-center">

              <div class="col-md-6">
              
              <div class="mt-3 inputs">
               
                <form action="hisseSorgula.php" method="get" target="_blank">
                <div class="countrySearch">
         <input type="text" id="country" name="name" class="form-control" placeholder="Hisse Seç...">
         <div id="suggestions"></div>
      </div>
                      <i class="fa fa-search inputAraSimge"></i>
                      <br>
                      <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> İncele</button>
                      
                </form>
                  </div>
                
              </div>
              
            </div>
            
          </div>
          <br><br><br><br><br>
          <p class="anasayfa-text">
           <i>Hisse Eksperi, Borsa Koçu, Özel Eğitim Grupları ve daha fazlası,</i> 
            <b>BORSAMATIC</b>'te.. <i>Sende Hemen Kayıt Ol!</i> </p>
  </center>
   
  <?php include 'inc/telegramButon.php' ?>
    


</body>
<?php include 'inc/footer.php'; ?>
</html>