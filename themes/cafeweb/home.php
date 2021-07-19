<?php $v->layout("_theme"); ?>
<section class="header_container">
    <div class="container">
        <article class="card_header">
            <h1 class="animate__animated animate__fadeIn"><?= $home->title; ?></h1>
            <p class="animate__animated animate__fadeInRight">
                <?= $home->subtitle; ?>
            </p>
            <div class="group_button_header animate__animated animate__fadeInUp">
                <a href="" class="button btn_medium btn_blue">
                    <div class="box_i"><i class="fas fa-chevron-right i_r"></i><i class="fas fa-chevron-right i_l"></i>
                    </div> Learn More
                </a>
            </div>
        </article>
    </div>
</section><!-- end header container -->
<section class="main_services">
    <div class="container">
        <header class="title_header">
            <h1>Services</h1>
        </header><!-- end header service -->
        <div class="box_service_container">
            <?php foreach($products as $product): ?>
            <article class="animate__animated animate__fadeInUp">
                <div class=" image_capa">
                    <a href="<?= url("/service/{$product->uri}"); ?>" class="moud_round">
                        <img src="<?= url("/storage/{$product->cover}"); ?>" alt="<?= $product->title; ?>"
                            title="<?= $product->title; ?>" />
                        <img class="img" src="<?= theme("/assets/images/round_img.png"); ?>" alt="moude_img" />
                    </a>
                </div>
                <h3><?= $product->title; ?></h3>
            </article>
            <?php endforeach; ?>
        </div><!-- end box service container -->
        <section class="main_sub_section">
            <article data-anime="left">
                <div class="box_img_center">
                    <img src="<?= url("/storage/{$home->cover}"); ?>" alt="Model Make" />
                </div>
            </article>
            <article class="desc_container" data-anime="right">

                <?= html_entity_decode($home->content); ?>

                <div class="group_button_header animate__animated animate__fadeInUp">
                    <a href="" class="button btn_medium btn_blue">
                        <div class="box_i"><i class="fas fa-chevron-right i_r"></i><i
                                class="fas fa-chevron-right i_l"></i>
                        </div> Learn More
                    </a>
                </div>
            </article>
        </section><!-- end main sub service -->
    </div>
    <section class="main_optin_footer">
        <div class="container f_x_flex">
            <div class="x_2" data-anime="left">

                <p>
                    <?= $home->description; ?>
                </p>
            </div>

            <div class="x_2 group_footer_buttons" data-anime="right">
                <?php foreach($site as $value): ?>
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
        </div>
    </section>
</section>