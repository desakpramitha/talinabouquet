<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/admin_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Change Password</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url(); ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item">Change Password</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <?= $user['name'] ?>!</h2>
            <p class="section-lead">
                Change your account password on this page.
            </p>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <form action="<?= base_url() ?>admin/admin_controller/changePassword" method="post">
                            <!-- class="needs-validation" novalidate="" -->
                            <div class="card-header">
                                <h4>Change Password</h4>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Current Password</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="current_password" name="user_id" value="<?= $user['user_id'] ?>" class="form-control">
                                        <input type="password" id="current_password" name="current_password" class="form-control">
                                        <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                        <!-- <= form_error('current_password', '<div class="invalid-feedback"><p>', '</p></div>'); ?> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="new_password" name="new_password" class="form-control">
                                        <?= form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                                        <!-- <= form_error('new_password', '<div class="invalid-feedback">' , '</div>' ); ?> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                        <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>