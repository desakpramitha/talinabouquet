<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/product_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/product_controller/index">Products</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row p-3">
                <div class="col p-5 mr-3 card">

                    <?php if (!$image) : ?>
                        <div class="col-12 col-lg-12 text-center">
                            <div class="p-5">
                                <h5>No Image Available</h5>
                            </div>
                        </div>
                    <?php else : ?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <?php $codeview = 0; ?>
                            <?php foreach ($image as $i) {   ?>
                                <?php $codeview++; ?>
                                <?php if ($codeview == 1) { ?>

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" class="d-block w-100" alt="...">
                                        </div>
                                    <?php } else { ?>
                                        <div class="carousel-item">
                                            <img src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" class="d-block w-100" alt="...">
                                        </div>
                                <?php }
                            } ?>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                        </div>
                    <?php endif ?>
                </div>

                <?php foreach ($product as $p) : ?>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col card p-3">
                                <div class="card-header">
                                    <h5>Product Detail</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-5">Product ID</dt>
                                        <dd class="col-sm-7"><?= $p['product_id'] ?></dd>

                                        <dt class="col-sm-5">Product Name</dt>
                                        <dd class="col-sm-7"><?= $p['product_name'] ?></dd>

                                        <dt class="col-sm-5">Category Name</dt>
                                        <dd class="col-sm-7"><?= $p['category_name'] ?></dd>

                                        <dt class="col-sm-5">Price</dt>
                                        <dd class="col-sm-7"><?= $p['price'] ?></dd>

                                        <dt class="col-sm-5">Description</dt>
                                        <dd class="col-sm-7"><?= $p['description'] ?></dd>
                                    </dl>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-danger rounded-pill" data-toggle="modal" data-target="#deleteProductModal<?= $p['product_id'] ?>"><i class="fas fa-trash"></i> Delete Product</button>
                                    <a class="btn btn-success rounded-pill" href="<?= base_url() ?>admin/product_controller/addImage/<?= $p['product_id'] ?>"><i class="fas fa-plus"></i> Add Images</a>

                                </div>
                            </div>
                        </div>
                        <div class="col card">

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- Modal Delete Image Product-->
    <?php foreach ($product as $p) : ?>
        <div class="modal fade" id="deleteProductModal<?= $p['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-danger" id="exampleModalLabel">Delete Data Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('admin/product_controller/deleteProduct/' . $p['product_id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            Are you sure to delete <span class="badge badge-danger"><?= $p['product_id']; ?> <?= $p['product_name']; ?></span>?
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
</div>