<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/service/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$category): ?>
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Create SubCategory</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/subcategory"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <label class="label">
                <span class="legend">*Títle:</span>
                <input type="text" name="title" placeholder="The name of the subcategory" required />
            </label>

            <label class="label">
                <span class="legend">*Description:</span>
                <textarea name="description" placeholder="About this subcategory" required></textarea>
            </label>

            <label class="label">
                <span class="legend">Capa:</span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>
            <label class="label">
                <span class="legend">Category</span>
                <select name="idcategory">
                    <?php
                            foreach ($categories as $value) {
                                echo "<option value=\"{$value->id}\">{$value->title}</option>";
                            }
                        ?>
                </select>
            </label>

            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Create SubCategory</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <header class="dash_content_app_header">
        <h2 class="icon-bookmark-o"> <?= $category->title; ?></h2>
        <!--             <a class="icon-link btn btn-green" href="<?= url("/product/em/{$category->uri}"); ?>" target="_blank"
               title="">Ver no site</a> -->
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/subcategory/{$category->id}"); ?>" method="post">
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
            <label class="label">
                <span class="legend">Category</span>
                <select name="idcategory">
                    <?php
                            foreach ($categories as $value) {
                                $categoryId = $post->category;
                                $select = function($value) use ($categoryId){
                                    return ($categoryId == $value ? "selected" : "");
                                }
                                ?>
                    <option <?= $select($value->id); ?> value="<?= $value->id; ?>"><?= $value->title; ?></option>
                    <?php
                            }
                        ?>
                </select>
            </label>
            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Update</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</section>