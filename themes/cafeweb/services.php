<?php $v->layout("_theme"); ?>
<section class="header_container_services">
    <article class="card_header_services">
        <div class="container service_flex_container">
            <h1 class="animate__animated animate__fadeIn">Services</h1>
            <div class="breadcrumb">
                <a href="<?= url("/"); ?>" class="animate__animated animate__fadeInLeft">Home</a> <small>|</small> <a
                    href="#" class="animate__animated animate__fadeInRight">Services</a>
            </div>
        </div>
    </article>
</section><!-- end header container -->
<section class="main_services service_line_bottom">
    <div class="container">
        <div class="box_service_container">
            <?php foreach($products as $product): ?>
            <article class="animate__animated animate__fadeInUp">
                <div class=" image_capa">
                    <a href="<?= url("/service/{$product->uri}") ?>" class="moud_round">
                        <img src="<?= url("/storage/{$product->cover}"); ?>" alt="<?= $product->title; ?>"
                            title="<?= $product->title; ?>" />
                        <img class="img" src="<?= theme("/assets/images/round_img.png"); ?>" alt="moude_img" />
                    </a>
                </div>
                <h3><?= $product->title; ?></h3>
            </article>
            <?php endforeach; ?>
        </div><!-- end box service container -->
        <div class="box-paginator">
            <?= $paginator; ?>
        </div>
    </div>
</section>