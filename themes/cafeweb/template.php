<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2021-03-29T10:32:56-03:00+163467">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Up Beauty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="assets/css/boot.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/slick-theme.css" />
    <link rel="stylesheet" href="assets/css/splide.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header class="main-header">
        <h1 class="h1__none">Up Beauty</h1>
        <div class="container">
            <div class="box_header">
                <div class="box_logo">
                    <a href="/home" class="animate__animated animate__bounce">
                        <img src="assets/images/logo.png" alt="Logo Up Beauty" title="Up Beauty" />
                    </a>
                </div><!-- end box logo -->
                <div class="container_nav">
                    <ul class="main_ul">
                        <li><a href="home">Home</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="services">Services</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                    <div class="main_ul_mobil animate__animated animate__backInRight">
                        <span class="open_nav"><i class="fas fa-bars i_open"></i><i
                                class="fas fa-times i_close"></i></span>
                        <a href="/home"><i class="fas fa-home"></i> <span>Home</span></a>
                        <a href="/about"><i class="fas fa-address-card"></i> <span>About</span></a>
                        <a href="/services"><i class="fas fa-paint-brush"></i> <span>Services</span></a>
                        <a href="/contact"><i class="far fa-paper-plane"></i> <span>Contact</span></a>
                    </div>
                </div><!-- end container nav -->
            </div><!-- end box header -->
        </div><!-- end container -->
    </header>
    <!-- end header -->
    <main class="main-container">
        <?php 
           $url = isset($_GET['url']) ? explode("/", @$_GET['url'])[1] : "home";

            if(file_exists($url . '.php')){
                include($url.'.php');
            }
        ?>
    </main>
    <!-- end main -->
    <footer class="main-footer">
        <h1 class="h1__none">Up Beauty Rodapé</h1>
        <div class="container">
            <div class="container_items">
                <div class="card_w_4">
                    <div class="box_logo_footer">
                        <img src="assets/images/logo.png" alt="Up Beauty" title="Up Beauty" />
                    </div>
                </div>
                <div class="card_w_4 f_title f_span">
                    <h2>Address</h2>
                    <span>4 Wrottesley Road</span>
                    <span>London NW10 5YL</span>
                </div>
                <div class="card_w_4 f_title f_span">
                    <h2>Contact</h2>
                    <span>07725 042406</span>
                    <span>07725 042406</span>
                </div>
                <div class="card_w_4 f_title f_social">
                    <h2>Social Media</h2>
                    <a target="_blank" href="" class="f_icon instagram" title="Follow on Instagram"><i
                            class="fab fa-instagram"></i></a>
                    <a target="_blank" href="" class="f_icon facebook" title="Follow on Facebook"><i
                            class="fab fa-facebook-square"></i></a>
                </div>
            </div><!-- end container items footer -->
        </div><!-- end container -->
        <p class="copy">Copyright © 2021 Up Beauty. All rights reserved. By Bagagem.digital</p>
    </footer>
    <!-- end footer -->
    <script src="https://kit.fontawesome.com/86f5b0a58f.js" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/anime.js"></script>

</body>

</html>

<!--
    
    
    
    
    

    home
   
    about
    
    service
    <i class="fas fa-cogs"></i>
    <i class="fas fa-user-cog"></i>
    <i class="fas fa-paint-brush"></i>
    contact
    <i class="fas fa-envelope-square"></i>
    <i class="fas fa-mail-bulk"></i>
    <i class="far fa-paper-plane"></i>


    
 -->