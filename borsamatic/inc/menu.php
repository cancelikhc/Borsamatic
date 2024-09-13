<!-- Menü -->
<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
    <div class="container">
        <a href="/" class="navbar-brand d-flex w-30 me-auto"><img src="img/logo.png" class="img-fluid menu-logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center">

                <li class="nav-item">
                    <a class="nav-link <?php if($page== 'anaSayfa'){echo 'active';} ?>" href="index.php">Ana Sayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($page== 'bist'){echo 'active';} ?>" href="bist.php">BIST</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if($page== 'guncelKatilimEndeksi'){echo 'active';} ?>" href="guncelKatilimEndeksi.php">Güncel Katılım Endeksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($page== 'borsaBlog'){echo 'active';} ?>" href="borsaBlog.php">Borsa Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($page== 'iletisim'){echo 'active';} ?>" href="iletisim.php">İletişim</a>
                </li>

                
            </ul>
            <ul class="nav navbar-nav ms-auto w-100 justify-content-end">

            


                <li class="nav-item menu-giris">
                <button type="button" class="btn btn-outline-success" onclick="girisYap()">Giriş Yap</button>
                </li>
                &nbsp;
                <li class="nav-item menu-kaydol">
                <button type="button" class="btn btn-outline-danger" onclick="kayitOl()">Kayıt Ol</button>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
<script>
function kayitOl()
{
     location.href = "/borsamatic/user/";
} 
</script>
<script>
function girisYap()
{
     location.href = "/borsamatic/user/";
} 
</script>
<!-- Menü -->