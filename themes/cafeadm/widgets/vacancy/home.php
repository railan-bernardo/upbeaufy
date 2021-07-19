<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/vacancy/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="">Lista de Interessados</h2>
    </header>

    <div class="dash_content_app_box" style="width: 800px;">
    
            <div class="app_users_home">
    <?php if(!$posts): ?>
        <div class="message info icon-info">Nemhum interessado.</div>
                <?php else: ?>
                <table>
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $contact):?>

                        <tr>
                            <td><?= $contact->first_name; ?></td>
                            <td><?= $contact->email; ?></td>
                            <td><?= date('d/m/Y', strtotime($contact->created_at)); ?></td>
                            <td>
                                <a href="<?= url("/admin/candidato/post/{$contact->id}"); ?>" class="btn btn-blue" style="margin-right: 5px;">Ver Mais</a>
                                <a href="#" class="remove_link"
                                   data-post="<?= url("/admin/candidato/post/{$contact->id}"); ?>"
                                   data-action="delete"
                                   data-confirm="ATENÇÃO: Tem certeza que deseja excluir?"
                                   data-post_id="<?= $contact->id; ?>">Excluir</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
<?php endif; ?>
            </div>

            <?= $paginator; ?>
  
    </div>
</section>
