<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/service/sidebar.php"); ?>

<div class="mce_upload" style="z-index: 997">
    <div class="mce_upload_box">
        <form class="app_form" action="<?= url("/admin/product/post"); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload" value="true" />
            <label>
                <label class="legend">Select an image JPG or PNG:</label>
                <input accept="image/*" type="file" name="image" required />
            </label>
            <button class="btn btn-blue icon-upload">Send Image</button>
        </form>
    </div>
</div>

<section class="dash_content_app">
    <?php if (!$post): ?>
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">Register Service</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/post"); ?>" method="post" enctype="multipart/form-data">
            <!-- ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <label class="label">
                <span class="legend">*Títle:</span>
                <input type="text" name="title" placeholder="Title " required />
            </label>

            <label class="label">
                <span class="legend">*Subtítle:</span>
                <textarea name="subtitle" placeholder="The supporting text" required></textarea>
            </label>


            <label class="label">
                <span class="legend">Capa: (1920x1080px)</span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>


            <label class="label">
                <span class="legend">Gallery: (1920x1080px)</span>
                <input type="file" name="cover_img[]" required multiple placeholder="Uma imagem de capa" />
            </label>



            <label class="label">
                <span class="legend">*Contents:</span>
                <textarea class="mce" name="content"></textarea>
            </label>


            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Category:</span>
                    <select name="category" required>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="label">
                    <span class="legend">*SubCategory:</span>
                    <select name="subcategory" required>
                        <?php foreach ($subcategories as $category): ?>
                        <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <option value="post">Publicar</option>
                        <option value="draft">Rascunho</option>
                        <option value="trash">Lixo</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Publication date:</span>
                    <input class="mask-datetime" type="text" name="post_at" value="<?= date("d/m/Y H:i"); ?>"
                        required />
                </label>
            </div>

            <div class="al-right">
                <button class="btn btn-blue icon-check-square-o">Register</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Edit Service #<?= $post->id; ?></h2>
        <a class="icon-link btn btn-green" href="<?= url("/produto/{$post->uri}"); ?>" target="_blank" title="">View
            site</a>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/product/post/{$post->id}"); ?>" method="post">
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
                <span class="legend">Capa: (1920x1080px)</span>
                <input type="file" name="cover" placeholder="Uma imagem de capa" />
            </label>

            <!--                  <label class="label">
                    <span class="legend">Galeria: (1920x1080px)</span>
                    <input type="file" name="cover_img[]" multiple placeholder="Uma imagem de capa"  />
                </label> -->



            <label class="label">
                <span class="legend">*Contents:</span>
                <textarea class="mce" name="content"><?= $post->content; ?></textarea>
            </label>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Category:</span>
                    <select name="category" required>
                        <?php foreach ($categories as $category):
                                $categoryId = $post->category;
                                $select = function ($value) use ($categoryId) {
                                    return ($categoryId == $value ? "selected" : "");
                                };
                                ?>
                        <option <?= $select($category->id); ?> value="<?= $category->id; ?>"><?= $category->title; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="label">
                    <span class="legend">*SubCategory:</span>
                    <select name="subcategory" required>
                        <?php foreach ($subcategories as $category): ?>
                        <?php

                                    $subCategoryId= $post->subcategory;
                                    $select = function($value) use($subCategoryId){
                                        return ($subCategoryId == $value ? "selected" : "");
                                    }
                                 ?>
                        <option <?= $select($category->id); ?> value="<?= $category->id; ?>"><?= $category->title; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <?php
                            $status = $post->status;
                            $select = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                        <option <?= $select("post"); ?> value="post">Publicar</option>
                        <option <?= $select("draft"); ?> value="draft">Rascunho</option>
                        <option <?= $select("trash"); ?> value="trash">Lixo</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Publication date:</span>
                    <input class="mask-datetime" type="text" name="post_at"
                        value="<?= date_fmt($post->post_at, "d/m/Y H:i"); ?>" required />
                </label>
            </div>

            <div class="al-right">
                <button class="btn btn-blue icon-pencil-square-o">Update</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</section>