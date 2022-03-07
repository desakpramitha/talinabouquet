<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/admin_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <?= $user['name'] ?>!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="<?= base_url() ?>assets/img/profile/<?= $user['image'] ?>" class="rounded-circle profile-widget-picture">
                        </div>
                        <div class="profile-widget-description ml-5 mr-5">
                            <div class="profile-widget-name">
                                <?= $user['name'] ?>
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> <?= $user['role_name'] ?>
                                </div>
                            </div>
                            <dl class="row">
                                <dt class="col-sm-1"><i class="text-primary fas fa-envelope"></i></dt>
                                <dd class="col-sm-10"><?= $user['email'] ?></dd>

                                <dt class="col-sm-1"><i class="text-primary fas fa-map-marker-alt"></i></dt>
                                <dd class="col-sm-10"><?= $user['address'] ?></dd>

                                <dt class="col-sm-1"><i class="text-primary fas fa-phone"></i></dt>
                                <dd class="col-sm-10"><?= $user['phone'] ?></dd>
                            </dl>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="<?= base_url() ?>admin/admin_controller/profileAdmin" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="hidden" name="user_id" class="form-control" value="<?= $user['user_id'] ?>" readonly>
                                        <input type="text" class="form-control" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>">
                                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">

                                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>">
                                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Image</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img class="img-thumbnail" src="<?= base_url() ?>assets/img/profile/<?= $user['image'] ?>" alt="">
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>