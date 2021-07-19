<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/service/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Services</h2>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_blog_home">
                <?php if (!$posts): ?>
                <div class="message info icon-info">There are no registered products yet.</div>
                <?php else: ?>
                <?php foreach ($posts as $post):
                        $postCover = ($post->cover ? url("/storage/".$post->cover) : url("/storage/{$post->cover}"));
                        ?>
                <article>
                    <img style="width: 100%;" src="<?= url( '/storage/'. $post->cover); ?>" class="cover embed radius">
                    <h3 class="tittle">
                        <a target="_blank" href=" <?= url("/product/{$post->uri}"); ?>">
                            <?php if ($post->post_at > date("Y-m-d H:i:s")): ?>
                            <span class="icon-clock-o"><?= $post->title; ?></span>
                            <?php else: ?>
                            <span class="icon-check"><?= $post->title; ?></span>
                            <?php endif; ?>
                        </a>
                    </h3>

                    <div class="info">
                        <p class="icon-clock-o"><?= date_fmt($post->post_at, "d.m.y \à\s H\hi"); ?></p>
                        <p class="icon-bookmark"><?= $post->category()->title; ?></p>
                        <p class="icon-bar-chart"><?= $post->views; ?></p>
                        <p class="icon-pencil-square-o">
                            <?= ($post->status == "post" ? "Published" : ($post->status == "draft" ? "Rascunho" : "Lixo")); ?>
                        </p>
                    </div>

                    <div class="actions">
                        <a class="icon-pencil btn btn-blue" title=""
                            href="<?= url("/admin/product/post/{$post->id}"); ?>">To edit</a>

                        <a class="icon-trash-o btn btn-red" title="" href="#"
                            data-post="<?= url("/admin/product/post"); ?>" data-action="delete"
                            data-confirm="Are you sure you want to delete this post?"
                            data-post_id="<?= $post->id; ?>">Delete</a>
                    </div>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>