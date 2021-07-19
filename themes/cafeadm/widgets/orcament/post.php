<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/orcament/sidebar.php"); ?>



<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="">Orçamento # <?= $post->id; ?></h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form"  method="post">
            <!-- ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>
            <label class="label">
                <span class="legend">Tipo: </span>
                <input  type="text" disabled value="<?= $post->juridic; ?>" />
            </label>
            <label class="label">
                <span class="legend">Nome: </span>
                <input  type="text" disabled value="<?= $post->first_name; ?>" />
            </label>

            <label class="label">
                <span class="legend">E-mail: </span>
                <input  type="text" disabled value="<?= $post->email; ?>" />
            </label>

            <label class="label">
                <span class="legend">Telefone Fixo: </span>
                <input  type="text" disabled value="<?= $post->telephone; ?>" />
            </label>

            <label class="label">
                <span class="legend">Celular: </span>
                <input  type="text" disabled value="<?= $post->phone; ?>" />
            </label>

            <label class="label">
                <span class="legend">Estado: </span>
                <input  type="text" disabled value="<?= $post->state; ?>" />
            </label>

            <label class="label">
                <span class="legend">Cidade: </span>
                <input  type="text" disabled value="<?= $post->city; ?>" />
            </label>

            <label class="label">
                <span class="legend">Endereço: </span>
                <input  type="text" disabled value="<?= $post->address; ?>" />
            </label>

            <label class="label">
                <span class="legend">CEP: </span>
                <input  type="text" disabled value="<?= $post->zipcode; ?>" />
            </label>



            <label class="label">
                <span class="legend">Mensage: </span>
             
                <textarea disabled><?= $post->msg; ?></textarea>
            </label>

<!--             <label class="label">
               <a href="" download class="btn btn-blue fas fa-file-pdf">Baixar Curriculo</a>
            </label> -->

        </form>
    </div>

</section>

