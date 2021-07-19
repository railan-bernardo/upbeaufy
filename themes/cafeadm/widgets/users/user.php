<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/users/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$user): ?>
    <header class="dash_content_app_header">
        <h2 class="icon-plus-circle">New User</h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/users/user"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create" />

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*First Name:</span>
                    <input type="text" name="first_name" placeholder="First Name" required />
                </label>

                <label class="label">
                    <span class="legend">*Last Name:</span>
                    <input type="text" name="last_name" placeholder="Last Name" required />
                </label>
            </div>

            <label class="label">
                <span class="legend">Gender:</span>
                <select name="genre">
                    <option value="male">Male</option>
                    <option value="female">Feminine</option>
                    <option value="other">Others</option>
                </select>
            </label>

            <label class="label">
                <span class="legend">Photograph: (600x600px)</span>
                <input type="file" name="photo" />
            </label>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">Birth:</span>
                    <input type="text" class="mask-date" name="datebirth" placeholder="dd/mm/yyyy" />
                </label>

                <label class="label">
                    <span class="legend">Documento:</span>
                    <input class="mask-doc" type="text" name="document" placeholder="User CPF" />
                </label>
            </div>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">Phone 1:</span>
                    <input type="text" class="mask-phone" name="phone1" />
                </label>

                <label class="label">
                    <span class="legend">Phone 2:</span>
                    <input class="mask-phone" type="text" name="phone2" />
                </label>
            </div>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*E-mail:</span>
                    <input type="email" name="email" placeholder="Better e-mail" required />
                </label>

                <label class="label">
                    <span class="legend">*Password:</span>
                    <input type="password" name="password" placeholder="Access password" required />
                </label>
            </div>
            <label class="label">
                <span class="legend">Facebook:</span>
                <input type="text" class="mask-phone" name="facebook" />
            </label>

            <label class="label">
                <span class="legend">Instagram:</span>
                <input class="mask-phone" type="text" name="instagram" />
            </label>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Level:</span>
                    <select name="level" required>
                        <option value="1">User</option>
                        <option value="5">Admin</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <option value="registered">Registered</option>
                        <option value="confirmed">Confirmed</option>
                    </select>
                </label>
            </div>

            <div class="al-right">
                <button class="btn btn-green icon-check-square-o">Create User</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <header class="dash_content_app_header">
        <h2 class="icon-user"><?= $user->fullName(); ?></h2>
    </header>

    <div class="dash_content_app_box">
        <form class="app_form" action="<?= url("/admin/users/user/{$user->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update" />

            <div class="label_g2">
                <label class="label">
                    <span class="legend">*First Name:</span>
                    <input type="text" name="first_name" value="<?= $user->first_name; ?>" placeholder="First Name"
                        required />
                </label>

                <label class="label">
                    <span class="legend">*Last Name:</span>
                    <input type="text" name="last_name" value="<?= $user->last_name; ?>" placeholder="Último nome"
                        required />
                </label>
            </div>

            <label class="label">
                <span class="legend">Gender:</span>
                <select name="genre">
                    <?php
                        $genre = $user->genre;
                        $select = function ($value) use ($genre) {
                            return ($genre == $value ? "selected" : "");
                        };
                        ?>
                    <option <?= $select("male"); ?> value="male">Male</option>
                    <option <?= $select("female"); ?> value="female">Female</option>
                    <option <?= $select("other"); ?> value="other">Others</option>
                </select>
            </label>

            <label class="label">
                <span class="legend">Photograph: (600x600px)</span>
                <input type="file" name="photo" />
            </label>

            <div class="label_g2">
                <label class="label">
                    <span class="legend">Birth:</span>
                    <input type="text" class="mask-date" value="<?= date_fmt($user->datebirth, "d/m/Y"); ?>"
                        name="datebirth" placeholder="dd/mm/yyyy" />
                </label>

                <label class="label">
                    <span class="legend">Document:</span>
                    <input class="mask-doc" type="text" value="<?= $user->document; ?>" name="document"
                        placeholder="User CPF" />
                </label>
            </div>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">Phone 1:</span>
                    <input type="text" class="mask-phone" value="<?= $user->phone1; ?>" name="phone1" />
                </label>

                <label class="label">
                    <span class="legend">Phone 2:</span>
                    <input class="mask-phone" type="text" value="<?= $user->phone2; ?>" name="phone2" />
                </label>
            </div>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*E-mail:</span>
                    <input type="email" name="email" value="<?= $user->email; ?>" placeholder="Better e-mail"
                        required />
                </label>

                <label class="label">
                    <span class="legend">Change Password:</span>
                    <input type="password" name="password" placeholder="Access password" />
                </label>
            </div>

            <label class="label">
                <span class="legend">Facebook:</span>
                <input type="text" class="mask-phone" value="<?= $user->facebook; ?>" name="facebook" />
            </label>

            <label class="label">
                <span class="legend">Instagram:</span>
                <input class="mask-phone" type="text" value="<?= $user->instagram; ?>" name="instagram" />
            </label>
            <div class="label_g2">
                <label class="label">
                    <span class="legend">*Level:</span>
                    <select name="level" required>
                        <?php
                            $level = $user->level;
                            $select = function ($value) use ($level) {
                                return ($level == $value ? "selected" : "");
                            };
                            ?>
                        <option <?= $select(1); ?> value="1">User</option>
                        <option <?= $select(5); ?> value="5">Admin</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">*Status:</span>
                    <select name="status" required>
                        <?php
                            $status = $user->status;
                            $select = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                        <option <?= $select("registered"); ?> value="registered">Registered</option>
                        <option <?= $select("confirmed"); ?> value="confirmed">Confirmed</option>
                    </select>
                </label>
            </div>

            <div class="app_form_footer">
                <button class="btn btn-blue icon-check-square-o">Update</button>
                <a href="#" class="remove_link icon-warning" data-post="<?= url("/admin/users/user/{$user->id}"); ?>"
                    data-action="delete"
                    data-confirm="ATTENTION: Are you sure you want to delete the user and all related data? This action cannot be done.!"
                    data-user_id="<?= $user->id; ?>">Delete User</a>
            </div>
        </form>
    </div>
    <?php endif; ?>
</section>