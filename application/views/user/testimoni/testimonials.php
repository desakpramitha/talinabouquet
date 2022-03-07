<!-- Main Content -->
<div class="main-content">
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background-image: url(<?= base_url() ?>assets/img/banner03-unsplash.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $title ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller">Home</a></li>
                        <li class="breadcrumb-item active text-white"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Services  -->
    <!-- <div class="services-box-main"> -->
    <div class="container">
        <?php if ($this->session->userdata('is_login')) : ?>
            <div class="row">
                <div class="col mt-5 d-flex justify-content-end">
                    <a class="btn btn-default hvr-hover text-white" href="<?= base_url() ?>user/testimoni_pelanggan_controller">Kelola Testimoni</a>
                </div>
            </div>
            <hr>

            <div class="row my-5">
                <?php foreach ($testimoni as $t) { ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service-block-inner">
                            <img class="img-fluid" src="<?= base_url() ?>assets/img/testimonials/<?= $t['image_testimoni'] ?>" alt="">
                            <blockquote class="blockquote text-right">
                                <p class="mb-0"><?= $t['description'] ?>.</p>
                                <footer class="blockquote-footer">
                                    <?= date('d M Y', $t['date']) ?>
                                </footer>
                                <div class="row mt-3">
                                    <small>
                                        <img class="img-fluid rounded-circle" width="40px" src="<?= base_url() ?>assets/img/profile/<?= $t['image'] ?>" alt="">
                                        <cite title="Source Title"> <?= $t['name'] ?></cite>
                                    </small>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php else : ?>
            <div class="row my-5">
                <?php foreach ($testimoni as $t) { ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service-block-inner">
                            <img class="img-fluid" src="<?= base_url() ?>assets/img/testimonials/<?= $t['image_testimoni'] ?>" alt="">
                            <blockquote class="blockquote text-right">
                                <p class="mb-0"><?= $t['description'] ?>.</p>
                                <footer class="blockquote-footer">
                                    <?= date('d M Y', $t['date']) ?>
                                </footer>
                                <div class="row mt-3">
                                    <small>
                                        <img class="img-fluid rounded-circle" width="40px" src="<?= base_url() ?>assets/img/profile/<?= $t['image'] ?>" alt="">
                                        <cite title="Source Title"> <?= $t['name'] ?></cite>
                                    </small>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
</div>