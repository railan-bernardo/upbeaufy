<?php $v->layout("_theme"); ?>
<section class="header_container_services">
    <article class="card_header_services">
        <div class="container service_flex_container">
            <h1 class="animate__animated animate__fadeIn">Contact</h1>
            <div class="breadcrumb">
                <a href="<?= url("/"); ?>" class="animate__animated animate__fadeInLeft">Home</a> <small>|</small> <a
                    href="#" class="animate__animated animate__fadeInRight">Contact</a>
            </div>
        </div>
    </article>
</section><!-- end header container -->
<div class="container">
    <section class="main_contact">
        <article class="box_contact">
            <form class="form" action="<?= url("/contact/post"); ?>" method="post">
                <div class=""><?= flash(); ?></div>
                <?= csrf_input(); ?>
                <input type="hidden" name="action" value="create" />
                <label class="form-group">
                    <div class="lg_2 mg_r">
                        <span>First Name</span>
                        <input type="text" name="first_name" placeholder="First Name" />
                    </div>
                    <div class="lg_2">
                        <span>Last Name</span>
                        <input type="text" name="last_name" placeholder="Last Name" />
                    </div>
                </label>

                <label class="form-group wrap_span">
                    <span>E-mail</span>
                    <input type="text" name="email" placeholder="E-mail" />
                </label>
                <label class="form-group wrap_span">
                    <span>Phone</span>
                    <input type="text" name="phone" placeholder="Phone" />
                </label>
                <label class="form-group wrap_span">
                    <span>Message</span>
                    <textarea name="msg" placeholder="Message" rows="8" cols="12"></textarea>
                </label>
                <button type="submit" class="button_send">Send Messege</button>
            </form>
        </article>

        <article class="contact_right">
            <h1>Follow Me:</h1>
            <div class="f_social">
                <?php foreach($site as $value): ?>
                <a target="_blank" href="<?= $value->instagram; ?>" class="f_icon instagram"
                    title="Follow on Instagram"><i class="fab fa-instagram"></i></a>
                <a target="_blank" href="<?= $value->facebook; ?>" class="f_icon facebook" title="Follow on Facebook"><i
                        class="fab fa-facebook-square"></i></a>
                <?php endforeach; ?>
            </div>
        </article>
    </section>
</div>