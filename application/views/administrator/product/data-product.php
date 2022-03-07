<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>dashboard_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item">Products</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far"><img src="<?= base_url() ?>assets/img/bouquet1.svg" width="40px" alt=""></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Product</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables Product -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col-sm-4 font-weight-bold text-primary">Data Tables Product</h6>
                <div class="col-sm-8 d-flex justify-content-end">
                    <a class="btn btn-primary btn-rounded mr-3" href="<?= base_url(); ?>admin/product_controller/addProduct"><i class="fas fa-plus"></i> Add Product</a>
                    <a class="btn btn-success btn-rounded mr-3" href="<?= base_url(); ?>admin/product_controller/dataImage">List Image Product</a>
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Cover</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Cover</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($product as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p['product_id'] ?></td>
                                    <td><?= $p['product_name'] ?></td>
                                    <td><?= $p['category_name'] ?></td>
                                    <td>Rp. <?= number_format($p['price'], 0, ".", ",") ?></td>
                                    <td><img class="img-fluid" width="200px" height="250px" src="<?= base_url('assets/img/uploads/' . $p['image_product']); ?>" alt=""></td>
                                    <td>
                                        <a class="btn btn-info" href="<?= base_url(); ?>admin/product_controller/viewProduct/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-warning" href="<?= base_url(); ?>admin/product_controller/editProduct/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></a>
                                        <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#editProductModal<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit"></i></button> -->
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></button>
                                        <!-- <a class="btn btn-success" href="<?= base_url(); ?>admin/product_controller/imageProduct/<?= $p['product_id'] ?>" data-placement="bottom" title="Add Image"><i class="fas fa-image"></i></a> -->
                                        <a class="btn btn-success" href="<?= base_url(); ?>admin/product_controller/addImage/<?= $p['product_id'] ?>" data-placement="bottom" title="Add Image"><i class="fas fa-image"></i></a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>


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


<!-- Modal View Product-->
<?php foreach ($product as $p) : ?>
    <div class="modal fade" id="viewProductModal<?= $p['product_id'] ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Product Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col">
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
                    </div>

                    <div class="col">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-danger">Delete</button> -->
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<!-- Modal edit Product-->
<?php foreach ($product as $p) : ?>
    <div class="modal fade" id="editProductModal<?= $p['product_id'] ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('admin/product_controller/updateProduct'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>" class="form-control rounded-pill" id="" placeholder="Enter product name">
                            <input type="text" name="product_name" value="<?= $p['product_name'] ?>" class="form-control rounded-pill" id="" placeholder="Enter product name">
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="">Category</label>
                                <select class="form-control rounded-pill" name="category_id" id="exampleFormControlSelect1">
                                    <option value="<?= $p['category_id'] ?>" read-only><?= $p['category_name'] ?></option>
                                    <?php foreach ($category as $c) : ?>
                                        <option name="category_id" value="<?= $c['category_id'] ?>"><?= $c['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control rounded-pill" name="price" value="<?= $p['price'] ?>" id="" placeholder="Enter price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="">Description</label><br>
                                        <textarea name="description" class="form-control rounded" id="" cols="55" rows="4"><?= $p['description'] ?></textarea>
                                        <?= form_error('description', '<div class="text-danger">', '</div>') ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="">Image</label><br>
                                        <input type="file" class="form-control rounded-pill" name="image_product" id="preview_gambar">
                                        <?= form_error('image_product', '<div class="text-danger">', '</div>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <img class="img-thumbnail" src="<?= base_url() ?>assets/img/uploads/<?= $p['image_product'] ?>" id="gambar_load" alt="">
                                <p><?= $p['image_product'] ?></p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="<?= base_url(); ?>admin/product_controller/imageProduct/<?= $p['product_id'] ?>"><i class="fas fa-image"></i> Add Image Product</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Delete Product-->
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
                <div class="modal-body">
                    <form action="<?php echo base_url('admin/product_controller/deleteProduct/' . $p['product_id']); ?>" method="post" enctype="multipart/form-data">
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        bacaGambar(this);
    })
</script>