<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/product_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Product Images</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/product_controller/index">Products</a></div>
                <div class="breadcrumb-item">Product Images</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col p-5 mr-4 card">

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

                </div>

                <?php foreach ($product as $p) : ?>

                    <div class="col-md-5 p-3 card form-group">
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
                    </div>
            </div>

            <div class="row">
                <!-- DataTales Example -->
                <div class="col card shadow mb-4">
                    <div class="row card-header py-3">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Detail Image</h6>
                        </div>
                        <div class="col">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-success rounded-pill" data-toggle="modal" data-target="#addImageProductModal"><i class="fas fa-plus"></i> Add Image</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Image ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Image ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($image as $i) : ?>
                                        <tr>
                                            <td><?= $i['image_id'] ?></td>
                                            <td><?= $i['image_name'] ?></td>
                                            <td><img class="img-fluid" width="200px" src="<?= base_url('assets/img/uploads/' . $i['image_name']); ?>" alt=""></td>
                                            <td>
                                                <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editImageModal<?= $i['image_id'] ?>"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteImageModal<?= $i['image_id'] ?>"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>


</div>
</section>

<!-- Modal Add Image Product-->
<div class="modal fade" id="addImageProductModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('admin/product_controller/addImageProduct'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product</label><br>
                        <select class="form-control rounded-pill" name="product_id" name="product_id" id="">
                            <?php foreach ($product as $p) : ?>
                                <option name="product_id" value="<?= $p['product_id'] ?>"><?= $p['product_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label><br>
                        <input type="file" class="form-control form-input-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Image-->
<?php foreach ($image as $i) : ?>
    <div class="modal fade" id="editImageModal<?= $i['image_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-success" id="exampleModalLabel">Edit Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/product_controller/updateImageProduct'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""><?= $i['image_id'] ?> <?= $i['image_name'] ?></label><br>
                            <img class="img-fluid" width="200px" src="<?= base_url('assets/img/uploads/' . $i['image_name']); ?>" alt=""><br>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label><br>
                            <input type="hidden" name="image_id" value="<?= $i['image_id'] ?>">
                            <input type="file" class="form-control form-input-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Delete Image Product-->
<?php foreach ($image as $i) : ?>
    <div class="modal fade" id="deleteImageModal<?= $i['image_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-danger" id="exampleModalLabel">Delete Data Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/product_controller/deleteImageProduct/' . $i['image_id']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        Are you sure to delete <span class="badge badge-danger"><?= $i['image_id']; ?> <?= $i['image_name']; ?></span>?
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