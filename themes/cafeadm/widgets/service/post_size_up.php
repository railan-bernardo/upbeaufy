<?php $v->layout("_admin"); ?>


<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2>Tamanhos</h2>
        <a class="icon-link btn btn-green" href="<?= url("/admin/produto/post_size/{$post->id}"); ?>">Novo</a>
    </header>

    <div class="dash_content_app_box" style="width: 850px;">
        <section>
            <div class="app_users_home">
    <?php if(!$id): ?>
        <div class="message info icon-info">Nada ainda.</div>
                <?php else: ?>
                <table>
                    <thead>
                    <tr>
                        <th>Tamanho</th>
                        <th>Cor</th>
                        <th>Peso</th>
                        <th>Quantidade de Pessoas</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($id as $size):?>

                        <tr>
                            <td><?= $size->size; ?></td>
                            <td style="background:<?= $size->color; ?>;"><?= $size->color; ?></td>
                            <td><?= $size->weight; ?></td>
                            <td><?= $size->persons; ?></td>
                            <td>
                                <a href="<?= url("/admin/produto/post_size_update/{$size->id}"); ?>" class="btn btn-yellow">Editar</a>
                                <a href="#" class="remove_link"
                                   data-post="<?= url("/admin/produto/post_size_update/{$size->id}"); ?>"
                                   data-action="delete"
                                   data-confirm="ATENÇÃO: Tem certeza que deseja excluir?"
                                   data-post_id="<?= $size->id; ?>">Excluir</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
<?php endif; ?>
            </div>

        </section>
    </div>
</section>