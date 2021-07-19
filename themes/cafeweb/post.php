<?php  $v->layout("_theme"); ?>
<section class="header_container_services">
    <article class="card_header_services">
        <div class="container service_flex_container">
            <h1 class="animate__animated animate__fadeIn"><?= $post->title ?></h1>
            <div class="breadcrumb">
                <a href="<?= url("/"); ?>" class="animate__animated animate__fadeInLeft">Home</a> <small>|</small> <a
                    href="#" class="animate__animated animate__fadeInRight"><?= $post->category()->title; ?></a>
                <small>|</small> <a href="#" class="animate__animated animate__fadeInRight"><?= $post->title ?></a>
            </div>
        </div>
    </article>
</section><!-- end header container -->
<div class="container">
    <section class="main_service_post service_line_bottom">
        <article class="slide_container">
            <div class="slide">
                <div class="slide_gallery box_slide">
                    <?php if(!$photos): ?>
                    <a href="<?= theme("/assets/images/default.jpg"); ?>" class="slick-slide">
                        <img src="<?= theme("/assets/images/default.jpg"); ?>" alt="Image Default">
                    </a>
                    <?php else: ?>
                    <?php foreach($photos as $value): ?>
                    <a href="<?= url("/storage/{$value->cover_img}"); ?>" class="slick-slide">
                        <img src="<?= url("/storage/{$value->cover_img}"); ?>" alt="<?= $post->title; ?>">
                    </a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="group_contacts">
                <?php  foreach($site as $value): ?>
                <a href="https://web.whatsapp.com/send?phone=<?= $value->phone_wp; ?>&text=<?= $value->msg; ?>"
                    class="button btn_medium btn_blue desktop">
                    <i class="fab fa-whatsapp"></i> Whatsapp
                </a>

                <a href="https://api.whatsapp.com/send?phone=<?= $value->phone_wp; ?>&text=<?= $value->msg; ?>"
                    class="button btn_medium btn_blue smartphone">
                    <i class="fab fa-whatsapp"></i> Whatsapp
                </a>

                <a href="tel:<?= $value->phone_wp; ?>" class="button btn_medium btn_blue">
                    <i class="fas fa-phone-alt"></i> Call Up Beauty
                </a>
                <?php endforeach; ?>
            </div>
        </article>
        <article class="desc_post">

            <?= html_entity_decode($post->content); ?>

        </article>
    </section>
</div>
<script src="<?= theme("/assets/js/jquery.js"); ?>"></script>
<script src="<?= theme("/assets/js/splide.min.js"); ?>"></script>
<script src="<?= theme("/assets/js/slick.min.js"); ?>"></script>
<script src="<?= theme("/assets/js/lighbox.js"); ?>"></script>
<script>
(function() {
    var $gallery = new SimpleLightbox('.box_slide a', {});
})();

$('.slide_gallery').slick({
    dots: false,
    infinite: true,
    speed: 300,

    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object

});
</script>