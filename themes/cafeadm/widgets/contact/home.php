<?php $v->layout("_admin"); ?>


<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="">Contacts</h2>
    </header>

    <div class="dash_content_app_box" style="width: 800px;">
        <section>
            <div class="app_users_home">
                <?php if(!$contacts): ?>
                <div class="message info icon-info">No contact.</div>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact):?>

                        <tr>
                            <td><?= $contact->first_name; ?></td>
                            <td><?= $contact->email; ?></td>
                            <td><?= $contact->phone; ?></td>
                            <td><?php if(!$contact->msg == "empty"): "" ?><?php else: ?><?= $contact->msg; ?>
                                <?php endif;?></td>
                            <td>
                                <a href="#" class="remove_link icon-warning"
                                    data-post="<?= url("/admin/contact/post/{$contact->id}"); ?>" data-action="delete"
                                    data-confirm="ATTENTION: Are you sure you want to delete?"
                                    data-post_id="<?= $contact->id; ?>">Delete</a>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>