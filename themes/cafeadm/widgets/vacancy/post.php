<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/vacancy/sidebar.php"); ?>



<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="">Interessado</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form"  method="post">
            <!-- ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <label class="label">
                <span class="legend">Nome: </span>
                <input  type="text" disabled value="<?= $user->first_name; ?>" />
            </label>

            <label class="label">
                <span class="legend">E-mail: </span>
                <input  type="text" disabled value="<?= $user->email; ?>" />
            </label>

            <label class="label">
                <span class="legend">Endereço: </span>
                <input  type="text" disabled value="<?= $user->address; ?>" />
            </label>

            <label class="label">
                <span class="legend">CEP: </span>
                <input  type="text" disabled value="<?= $user->zipcode; ?>" />
            </label>

            <label class="label">
                <span class="legend">Estado: </span>
                <input  type="text" disabled value="<?= $user->state; ?>" />
            </label>

            <label class="label">
                <span class="legend">Cidade: </span>
                <input  type="text" disabled value="<?= $user->city; ?>" />
            </label>

            <label class="label">
                <span class="legend">Mensage: </span>
             
                <textarea disabled><?= $user->msg; ?></textarea>
            </label>

            <label class="label">
               <a href="<?= url(""); ?>/storage/<?= $user->anexo; ?>" download class="btn btn-blue"><i class="fas fa-file-pdf" style="color: #fff; margin-right: 6px;"></i> Baixar Curriculo</a>
            </label>

        </form>
    </div>

</section>

