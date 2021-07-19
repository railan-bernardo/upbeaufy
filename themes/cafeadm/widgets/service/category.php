<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/service/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$category): ?>
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">New Category</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/category"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <label class="label">
                <span class="legend">*Títle:</span>
                <input type="text" name="title" placeholder="The name of the category" required />
            </label>

            <label class="label">
                <span class="legend">*Description:</span>
                <textarea name="description" placeholder="About this category" required></textarea>
            </label>

            <label class="label">
                <span class="legend">Capa:</span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>

            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Create Category</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <header class="dash_content_app_header">
        <h2 class="icon-bookmark-o"><?= $category->title; ?></h2>
        <!-- <a class="icon-link btn btn-green" href="<?= url("/produtos/em/{$category->uri}"); ?>" target="_blank"
               title="">Ver no site</a> -->
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/category/{$category->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update" />

            <label class="label">
                <span class="legend">*Títle:</span>
                <input type="text" name="title" value="<?= $category->title; ?>" placeholder="" required />
            </label>

            <label class="label">
                <span class="legend">*Description:</span>
                <textarea name="description" placeholder="" required><?= $category->description; ?></textarea>
            </label>

            <label class="label">
                <span class="legend">Capa:</span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>

            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Update</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</section>