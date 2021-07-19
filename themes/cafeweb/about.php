<?php $v->layout("_theme"); ?>
<section class="header_container_services">
    <article class="card_header_services">
        <div class="container service_flex_container">
            <h1 class="animate__animated animate__fadeIn">About</h1>
            <div class="breadcrumb">
                <a href="<?= url("/"); ?>" class="animate__animated animate__fadeInLeft">Home</a> <small>|</small> <a
                    href="#" class="animate__animated animate__fadeInRight">About</a>
            </div>
        </div>
    </article>
</section><!-- end header container -->
<div class="container">
    <section class="main_about">
        <article class="slide">
            <div class="container_capa_about">
                <?php foreach($gallery as $value): ?>
                <a href="<?= url("/storage/{$value->cover_img}"); ?>">
                    <img src="<?= url("/storage/{$value->cover_img}"); ?>" alt="image_about" />
                </a>
                <?php endforeach; ?>
            </div>
        </article>

        <article class="m__top">
            <?php foreach($about as $value): ?>
            <?= html_entity_decode($value->content); ?>
            <?php endforeach; ?>
        </article>
    </section>
</div>

<script src="<?= theme("/assets/js/jquery.js"); ?>"></script>
<script src="<?= theme("/assets/js/splide.min.js"); ?>"></script>
<script src="<?= theme("/assets/js/slick.min.js"); ?>"></script>
<script src="<?= theme("/assets/js/lighbox.js"); ?>"></script>
<script>
(function() {
    var $gallery = new SimpleLightbox('.container_capa_about a', {});
})();

$('.container_capa_about').slick({
    dots: false,
    infinite: true,
    speed: 300,

    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object

});
</script>