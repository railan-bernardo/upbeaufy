<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/siteinfo/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Site settings</h2>
    </header>

    <div class="dash_content_app_box">


        <?php if (!$posts): ?>
        <div class="message info icon-info">nothing registered.</div>
        <?php else: ?>
        <?php foreach ($posts as $post):
                       
                        ?>

        <form class="app_form" action="<?= url("/admin/footer/post/{$post->id}"); ?>" method="post">
            <!-- ACTION SPOOFING-->
            <input type="hidden" name="action" value="update" />

            <label class="label">
                <span class="legend">*Title:</span>
                <input type="text" name="title" value="<?= $post->title; ?>" placeholder="Title">
            </label>

            <label class="label">
                <span class="legend">*Description (SEO):</span>
                <input type="text" name="description" value="<?= $post->description; ?>" placeholder="Description SEO">
            </label>

            <label class="label">
                <span class="legend">*Contact Phone:</span>
                <input type="text" name="phone" value="<?= $post->phone; ?>" placeholder="Contact Phone">
            </label>
            <label class="label">
                <span class="legend">*contact message:</span>
                <input type="text" name="msg" value="<?= $post->msg; ?>" placeholder="contact message">
            </label>
            <label class="label">
                <span class="legend">*Whatsapp<small class="red"> (without spaces, dashes and parentheses)</small> DDD
                    number:</span>
                <input type="text" name="phone_wp" value="<?= $post->phone_wp; ?>" placeholder="Whatsapp 00000000000" />
            </label>
            <label class="label">
                <span class="legend">*E-mail:</span>
                <input type="text" name="email" value="<?= $post->email; ?>" placeholder="Contact E-mail">
            </label>

            <label class="label">
                <span class="legend">*Facebook:</span>
                <input type="text" name="facebook" value="<?= $post->facebook; ?>"
                    placeholder="https://facebook.com/name" />
            </label>

            <label class="label">
                <span class="legend">*Instagram:</span>
                <input type="text" name="instagram" value="<?= $post->instagram; ?>"
                    placeholder="https://instagram.com/name" />
            </label>

            <label class="label">
                <span class="legend">*Copyright:</span>
                <input type="text" name="copyright" value="<?= $post->copyright; ?>"
                    placeholder="EX: 2021 nome todos direitos reservados" />
            </label>


            <label class="label">
                <span class="legend">*Meta tags for SEO <small class="red">(separate by commas).</small> Max 10
                    tags:</span>
                <input type="text" name="meta_tag" value="<?= $post->meta_tag; ?>" placeholder="Ex: name, lorem">
            </label>
            <div class="al-right">
                <button class="btn btn-blue icon-pencil-square-o">Update</button>
            </div>
        </form>

        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>