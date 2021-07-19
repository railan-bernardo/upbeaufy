<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/services</h3>
    <p class="dash_content_sidebar_desc">Here you manage all services...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("fas fa-edit", "products/home", "Services");
        echo $nav("fas fa-bookmark", "product/categories", "Category");
         echo $nav("fas fa-bookmark", "product/subcategories", "SubCategory");
        echo $nav("fas fa-plus-circle", "product/post", "Register Service");
       //  echo $nav("fas fa-bookmark", "produtos/upload", "Galleria");
        ?>

        <?php if (!empty($post->cover)): ?>
        <img class="radius" style="width: 100%; margin-top: 30px" src="<?= url("/storage/".$post->cover); ?>" />
        <?php endif; ?>

        <?php if (!empty($category->cover)): ?>
        <img class="radius" style="width: 100%; margin-top: 30px" src="<?= url("/storage/".$category->cover); ?>" />
        <?php endif; ?>
    </nav>
</div>