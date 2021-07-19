<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/dash/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-home">Dash</h2>
    </header>

    <div class="dash_content_app_box">
        <section class="app_dash_home_stats">
            <article class="control radius">
                <h4 class=""><i class="fas fa-tags"></i> Services</h4>
                <p><b>Services:</b> <?= $service->subscribers; ?></p>
            </article>

            <article class="blog radius">
                <h4 class=""><i class="fas fa-edit"></i> Contacts</h4>
                <p><b>Contacts:</b> <?= $blog->posts; ?></p>
            </article>

            <article class="users radius">
                <h4 class=""><i class="fas fa-user"></i> Users</h4>
                <p><b>Users:</b> <?= $users->admins; ?></p>
            </article>
        </section>

        <section class="app_dash_home_trafic">
            <h3 class="icon-bar-chart">Online now:
                <span class="app_dash_home_trafic_count"><?= $onlineCount; ?></span>
            </h3>

            <div class="app_dash_home_trafic_list">
                <?php if (!$online): ?>
                <div class="message info icon-info">
                    There are no online users browsing the site at this time. When you have, you
                    you can monitor everyone here.
                </div>
                <?php else: ?>
                <?php foreach ($online as $onlineNow): ?>
                <article>
                    <h4>[<?= date_fmt($onlineNow->created_at, "H\hm"); ?> - <?= date_fmt($onlineNow->updated_at,
                                    "H\hm"); ?>]
                        <?= ($onlineNow->user ? $onlineNow->user()->fullName() : "Guest User"); ?></h4>
                    <p><?= $onlineNow->pages; ?> páginas vistas</p>
                    <p class="radius icon-link"><a target="_blank"
                            href="<?= url("/{$onlineNow->url}"); ?>"><b><?= strtolower(CONF_SITE_NAME); ?></b><?= $onlineNow->url; ?>
                        </a></p>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</section>

<?php $v->start("scripts"); ?>
<script>
$(function() {
    setInterval(function() {
        $.post('<?= url("/admin/dash/home");?>', {
            refresh: true
        }, function(response) {
            // count
            if (response.count) {
                $(".app_dash_home_trafic_count").text(response.count);
            } else {
                $(".app_dash_home_trafic_count").text(0);
            }

            //list
            var list = "";
            if (response.list) {
                $.each(response.list, function(item, data) {
                    var url = '<?= url();?>' + data.url;
                    var title = '<?= strtolower(CONF_SITE_NAME);?>';

                    list += "<article>";
                    list += "<h4>[" + data.dates + "] " + data.user + "</h4>";
                    list += "<p>" + data.pages + " pages view</p>";
                    list += "<p class='radius icon-link'>";
                    list += "<a target='_blank' href='" + url + "'><b>" + title +
                        "</b>" + data.url + "</a>";
                    list += "</p>";
                    list += "</article>";
                });
            } else {
                list = "<div class=\"message info icon-info\">\n" +
                    "There are no online users browsing the site at this time. When you have, you\n" +
                    "you can monitor everyone here.\n" +
                    "</div>";
            }

            $(".app_dash_home_trafic_list").html(list);
        }, "json");
    }, 1000 * 10);
});
</script>
<?php $v->end(); ?>