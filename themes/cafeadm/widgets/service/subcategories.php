<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/service/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">SubCategorys</h2>
        <a class="icon-plus-circle btn btn-green" href="<?= url("/admin/product/subcategory"); ?>">Create
            SubCategory</a>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_blog_categories">
                <?php if (!$categories): ?>
                <div class="message info icon-info">There are no subcategories registered yet</div>
                <?php else: ?>
                <?php foreach ($categories as $category):
                        $categoryCover = ($category->cover ? url("/storage/".$category->cover) : "");
                        ?>
                <article class="radius">
                    <div class="thumb">
                        <img style="width: 100; object-fit: cover; height: 150px;"
                            src="<?= url("/storage/".$category->cover); ?>" class="cover embed radius">
                    </div>
                    <div class="info">
                        <h3 class="title">
                            <?= $category->title; ?>
                            [ <b><?= $category->posts()->count(); ?> service </b> ]
                        </h3>
                        <p class="desc"><?= $category->description; ?></p>

                        <div class="actions">
                            <a class="icon-pencil btn btn-blue" title=""
                                href="<?= url("/admin/product/subcategory/{$category->id}"); ?>">To edit</a>

                            <a class="icon-trash-o btn btn-red" href="#" title=""
                                data-post="<?= url("/admin/product/subcategory"); ?>" data-action="delete"
                                data-confirm="Are you sure you want to delete the subcategory?"
                                data-subcategory_id="<?= $category->id; ?>">Delete</a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>


        </section>
    </div>
</section>