<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/orçamento</h3>
    <p class="dash_content_sidebar_desc">Gerenciar orçamentos...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("", "orcamento/home", "Orçamentos");
        //echo $nav("fas fa-plus-o", "gallery/post", "New Gallery");
        ?>

        <?php if (!empty($slide->cover)): ?>
            <img class="radius" style="width: 100%; margin-top: 30px" src="<?= url("/storage/".$slide->cover); ?>"/>
        <?php endif; ?>

    </nav>
</div>
