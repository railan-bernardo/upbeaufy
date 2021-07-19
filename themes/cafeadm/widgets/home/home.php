<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/home/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Page Home</h2>
    </header>

    <div class="dash_content_app_box">


        <?php if (!$posts): ?>
        <div class="message info icon-info">nothing registered.</div>
        <?php else: ?>
        <?php foreach ($posts as $post):
                       
     ?>

        <form class="app_form" action="<?= url("/admin/home/post/{$post->id}"); ?>" method="post">
            <!-- ACTION SPOOFING-->
            <input type="hidden" name="action" value="update" />

            <label class="label">
                <span class="legend">*Títle:</span>
                <input type="text" name="title" value="<?= $post->title; ?>" placeholder="" required />
            </label>

            <label class="label">
                <span class="legend">*Subtítle:</span>
                <textarea name="subtitle" placeholder="" required><?= $post->subtitle; ?></textarea>
            </label>


            <label class="label">
                <span class="legend">Image: </span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>



            <label class="label">
                <span class="legend">*Contents:</span>
                <textarea class="mce" name="content"><?= $post->content; ?></textarea>
            </label>

            <label class="label">
                <span class="legend">*Description:</span>
                <textarea name="description" placeholder="" required><?= $post->description; ?></textarea>
            </label>


            <div class="al-right">
                <button class="btn btn-blue icon-pencil-square-o">Update</button>
            </div>
        </form>

        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>