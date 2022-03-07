<!-- Main Content -->
<?php foreach ($users as $usr) : ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="<?= base_url(); ?>admin/user_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/user_controller/index">Data User</a></div>
                    <div class="breadcrumb-item">Edit Data User</div>
                </div>
            </div>
            <div class="section-body">
                <form action="<?= base_url(''); ?>admin/user_controller/updateUser/<?= $usr['user_id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row p-3">
                        <div class="col-md-5 mr-3 card">
                            <div class="card-header">
                                <h4>Foto Profil</h4>
                            </div>
                            <div class="card-body">
                                <img class="img-profile img-fluid" src="<?= base_url('assets/img/profile/') . $usr['image']; ?>">
                            </div>
                        </div>
                        <div class="card col">
                            <div class="card-header">
                                <h4>Data User</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="user_id" value="<?= $usr['user_id'] ?>" class="form-control rounded-pill">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">User Name</label>
                                    <input type="text" name="name" value="<?= $usr['name'] ?>" class="form-control rounded-pill" required placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Email</label>
                                    <input type="text" name="email" value="<?= $usr['email'] ?>" class="form-control rounded-pill" required placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Address</label>
                                    <input type="text" name="address" value="<?= $usr['address'] ?>" class="form-control rounded-pill" required placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Phone Number</label>
                                    <input type="text" name="phone" value="<?= $usr['phone'] ?>" class="form-control rounded-pill" required placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                                    <label class="font-weight-bold" for="">Password</label>
                                    <input type="password" name="password" class="form-control form-control-user rounded-pill" id="exampleInputPassword" placeholder="Password">


                                    <!-- <div class="col-sm-6">
                                        <label class="font-weight-bold" for="">Repeat Password</label>
                                        <input type="password" name="repeatPassword" class="form-control form-control-user rounded-pill" id="exampleRepeatPassword" placeholder="Repeat Password">
                                        <= form_error('repeatPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div> -->
                                </div>
                                <?php if ($usr['user_id'] == 16) : ?>
                                <?php else : ?>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label class="font-weight-bold" for="">Role</label>
                                            <select class="form-control rounded-pill" required name="role_id" value="<?= $r['role_id'] ?>" id="exampleFormControlSelect1">
                                                <option value=<?= $usr['role_id'] ?> read-only><?= $usr['role_name'] ?></option>
                                                <?php foreach ($role as $r) : ?>
                                                    <option name="role_id" value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label class="font-weight-bold" for="">Status Active</label>
                                            <?php if ($usr['is_active'] == 1) {
                                                $status = 'Active';
                                            } else if ($usr['is_active'] == 0) {
                                                $status = 'Nonactive';
                                            } ?>


                                            <select class="form-control rounded-pill" required value="<?= $usr['is_active'] ?>" name="is_active" id="exampleFormControlSelect1">
                                                <option value="<?= $usr['is_active'] ?>" name="is_active" read-only><?= $status ?></option>
                                                <option name="is_active" value="0">Nonactive</option>
                                                <option name="is_active" value="1">Active</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Image</label>
                                    <input type="file" name="image" class="form-control rounded-pill">
                                </div>
                                <div class="form-group">
                                    <label for="">Since <?= date('d M Y', $usr['date_created']) ?></label><br>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </div>
<?php endforeach; ?>

<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fas fa-eye-slash fa-eye");
        var input = $("#pass_log_id");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });
</script>