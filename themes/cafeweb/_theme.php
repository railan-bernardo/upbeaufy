<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2021-03-29T10:32:56-03:00+163467">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="<?= theme("/assets/css/lightbox.css"); ?>" />
    <link rel="stylesheet" href="<?= theme("/assets/css/splide.min.css"); ?>" />
    <link rel="stylesheet" href="<?= theme("/assets/css/slick.css"); ?>" />
    <link rel="stylesheet" href="<?= theme("/assets/css/slick-theme.css"); ?>" />
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>" />

</head>

<body>

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>

    <!--HEADER-->
    <header class="main-header">
        <h1 class="h1__none">Up Beauty</h1>
        <div class="container">
            <div class="box_header">
                <div class="box_logo">
                    <a href="<?= url("/"); ?>" class="animate__animated animate__bounce">
                        <img src="<?= theme("/assets/images/logo.png"); ?>" alt="Logo Up Beauty" title="Up Beauty" />
                    </a>
                </div><!-- end box logo -->
                <div class="container_nav">
                    <ul class="main_ul">
                        <li><a href="<?= url("/"); ?>">Home</a></li>
                        <li><a href="<?= url("/about"); ?>">About</a></li>
                        <li><a href="<?= url("/services"); ?>">Services</a></li>
                        <li><a href="<?= url("/contact"); ?>">Contact</a></li>
                    </ul>
                    <div class="main_ul_mobil animate__animated animate__backInRight">
                        <span class="open_nav"><i class="fas fa-bars i_open"></i><i
                                class="fas fa-times i_close"></i></span>
                        <a href="<?= url("/"); ?>"><i class="fas fa-home"></i> <span>Home</span></a>
                        <a href="<?= url("/about"); ?>"><i class="fas fa-address-card"></i> <span>About</span></a>
                        <a href="<?= url("/services"); ?>"><i class="fas fa-paint-brush"></i> <span>Services</span></a>
                        <a href="<?= url("/contact"); ?>"><i class="far fa-paper-plane"></i> <span>Contact</span></a>
                    </div>
                </div><!-- end container nav -->
            </div><!-- end box header -->
        </div><!-- end container -->
    </header>
    <!-- end header -->

    <!--CONTENT-->
    <main class="main-container">
        <?= $v->section("content"); ?>
    </main>

    <!--FOOTER-->
    <?php 
    use \Source\Models\SitePost;
    $site = (new SitePost())->find("", "phone, phone_wp, email, facebook, instagram")->fetch(true);
     ?>
    <footer class="main-footer">
        <h1 class="h1__none">Up Beauty Rodapé</h1>
        <div class="container">
            <div class="container_items">
                <div class="card_w_4">
                    <div class="box_logo_footer">
                        <img src="<?= theme("/assets/images/logo.png") ?>" alt="Up Beauty" title="Up Beauty" />
                    </div>
                </div>
                <div class="card_w_4 f_title f_span">
                    <h2>Address</h2>
                    <span>4 Wrottesley Road</span>
                    <span>London NW10 5YL</span>
                </div>
                <div class="card_w_4 f_title f_span">
                    <h2>Contact</h2>
                    <?php foreach($site as $value): ?>
                    <span>
                        <?php
                       $number = str_replace("/", "<br>", $value->phone);
                       echo $number;
                       ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <div class="card_w_4 f_title f_social">
                    <h2>Social Media</h2>
                    <?php foreach($site as $value): ?>
                    <a target="_blank" href="<?= $value->instagram; ?>" class="f_icon instagram"
                        title="Follow on Instagram"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" href="<?= $value->facebook; ?>" class="f_icon facebook"
                        title="Follow on Facebook"><i class="fab fa-facebook-square"></i></a>
                    <?php endforeach; ?>
                </div>
            </div><!-- end container items footer -->
        </div><!-- end container -->
        <p class="copy">Copyright © 2021 Up Beauty. All rights reserved. By Bagagem.digital</p>
    </footer>
    <!-- end footer -->
    <script src="https://kit.fontawesome.com/86f5b0a58f.js" crossorigin="anonymous"></script>
    <script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
    <script src="<?= theme("/assets/scripts.js"); ?>"></script>
    <script src="<?= theme("assets/js/anime.js") ?>"></script>

    <script src="<?= url("/shared/scripts/jquery.form.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/jquery.mask.js"); ?>"></script>
    <script src="<?= url("/shared/scripts/tinymce/tinymce.min.js"); ?>"></script>
    <script src="<?= url("/themes/cafeadm/assets/js/scripts.js", CONF_VIEW_ADMIN); ?>"></script>
    <?= $v->section("scripts"); ?>
</body>

</html>