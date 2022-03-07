<!-- Main Content -->
<div class="main-content">
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background-image: url(<?= base_url() ?>assets/img/banner03-unsplash.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $title ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>user/pelanggan_controller">Home</a></li>
                        <li class="breadcrumb-item active text-white"><a href="<?= base_url() ?>user/pelanggan_controller/testimonials">Testimonials</a></li>
                        <li class="breadcrumb-item active text-white"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Services  -->
    <div class="services-box-main">
        <div class="container">
            <div class="row">
                <div class="contact-info-right col-sm-1 ml d-flex justify-content-center">
                    <div class="submit-button">
                        <a class="btn hvr-hover" id="back" href="<?= base_url() ?>dashboard_controller/testimonials"><i class="fas fa-arrow-left text-white"></i></a>
                    </div>
                </div>
                <div class="contact-info-right col-sm-11">
                    <div class="row-sm-12 submit-button d-flex justify-content-end mb-3">
                        <a class="btn hvr-hover text-white " id="back" href="<?= base_url() ?>user/testimoni_pelanggan_controller/addTestimoni"><i class="fas fa-plus"></i> Add Testimoni</a>
                    </div>

                    <div class="row">
                        <div class="col">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-main table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <!-- <php if (!$testimoni) : ?>
                                            <td colspan="4">No data available</td>
                                        <php else : ?> -->

                                        <?php
                                        $no = 1;
                                        foreach ($testimoni as $t) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $t['description'] ?></td>
                                                <td><img class="img-fluid" width="300px" src="<?= base_url() ?>assets/img/testimonials/<?= $t['image_testimoni'] ?>" alt=""></td>
                                                <td>
                                                    <a class="btn btn-primary " href="<?= base_url() ?>user/testimoni_pelanggan_controller/editTestimoni/<?= $t['testimoni_id'] ?>"><i class="fas fa-edit"></i></a>
                                                    <a class="btn btn-danger text-light" data-toggle="modal" data-target="#deleteTestimoniModal<?= $t['testimoni_id'] ?>"><i class="fas fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <!-- <php endif; ?> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete testimoni-->
<?php foreach ($testimoni as $t) : ?>
    <div class="modal fade" id="deleteTestimoniModal<?= $t['testimoni_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold text-danger" id="exampleModalLabel">Delete Data Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>user/testimoni_pelanggan_controller/deleteTestimoni/<?= $t['testimoni_id'] ?>" method="post">
                        <h3>Are you sure to delete ?</h3>
                        <img class="img-fluid" width="300px" src="<?= base_url() ?>assets/img/testimonials/<?= $t['image_testimoni'] ?>" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>