<!-- Start Contact Us  -->

<!-- <div class="contact-box-main"> -->
<div class="container p-3">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="contact-info-left">
                <h2>User Information</h2>

                <div class="row d-flex justify-content-center mb-3">
                    <div class="align-self-center">
                        <img class="img-thumbnail" width="150px" src="<?= base_url() ?>assets/img/profile/<?= $user['image'] ?>" alt="">
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-2">
                    <div class="align-self-center">
                        <h3><b><?= $user['name'] ?></b> | <?= $user['role_name'] ?></h3>
                    </div>
                </div>
                <hr>

                <ul>
                    <li>
                        <p><i class="fas fa-map-marker-alt"></i>Address: <?= $user['address'] ?> </p>
                    </li>
                    <li>
                        <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:<?= $user['phone'] ?>"><?= $user['phone'] ?></a></p>
                    </li>
                    <li>
                        <p><i class="fas fa-envelope"></i>Email: <a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="contact-form-right">
                <h2>EDIT PROFILE</h2>
                <p>Hi, <b><?= $user['name'] ?></b> change Information about yourself on this form.</p>
                <form method="post" action="<?= base_url() ?>user/pelanggan_controller/profileUser" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    <div class="row">
                        <input type="hidden" value="<?= $user['user_id'] ?>" class="form-control" name="user_id" required data-error="Please enter your email">
                        <div class="col-md-12">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="form-group">
                                <input type="text" placeholder="Your Email" id="email" value="<?= $user['email'] ?>" class="form-control" name="email" readonly data-error="Please enter your email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" placeholder="Your Name">
                                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                <!-- <div class="help-block with-errors"></div> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="address" value="<?= $user['address'] ?>" name="address" placeholder="Address">
                                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="phone" value="<?= $user['phone'] ?>" name="phone" placeholder="Phone">
                                <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="image">Profile Image</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/profile/<?= $user['image'] ?>" alt="">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  mt-3">
                            <div class="submit-button text-center">
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