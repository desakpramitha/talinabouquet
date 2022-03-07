<!-- Start Contact Us  -->
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $title ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- <div class="contact-box-main"> -->
<div class="container p-4">
    <div class="row">

        <div class="col-sm-2">
            <div class="contact-form-right d-flex justify-content-end">
                <div class="submit-button">
                    <a class="btn hvr-hover" id="back" href="<?= base_url() ?>dashboard_controller/index"><i class="fas fa-arrow-left text-white"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-sm-10">
            <div class="contact-form-right">

                <h2>Change Password</h2>
                <p>Hi, <b><?= $user['name'] ?></b> change your account password .</p>

                <form method="post" action="<?= base_url() ?>user/pelanggan_controller/changePassword" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    <div class="row">
                        <input type="hidden" value="<?= $user['user_id'] ?>" class="form-control" name="user_id">
                        <div class="col-md-10">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                                <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                <!-- <div class="help-block with-errors"></div> -->
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                                <?= form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                                <!-- <div class="help-block with-errors"></div> -->
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-10 mt-3 d-flex justify-content-end">
                            <div class="submit-button">
                                <button class="btn hvr-hover" id="submit" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Cart -->