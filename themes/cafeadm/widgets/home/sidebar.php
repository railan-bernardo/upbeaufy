<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/site</h3>
    <p class="dash_content_sidebar_desc">To Manager...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("", "home/home", "Page Home");
        //echo $nav("", "footer/post", "New");
        ?>

        <?php
         if (!empty($posts)): 
            foreach($posts as $post):
         ?>
        <img class="radius" style="width: 100%; margin-top: 30px" src="<?= url("/storage/".$post->cover); ?>" />
        <?php endforeach; ?>
        <?php endif; ?>

    </nav>
</div>