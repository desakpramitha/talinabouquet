<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/product_controller/dataImage" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/product_controller/index">Products</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class=" row">
                <div class="col-md-5">
                    <?php foreach ($product as $p) : ?>
                        <div class="card" data-height="420px">
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
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Image Product</h5>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?php echo base_url('admin/product_controller/addImageProduct'); ?>" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-sm-5 form-group">
                                        <img class="img-thumbnail img-fluid" src="<?= base_url() ?>assets/img/no-image.png" id="gambar_load" height="100px" alt="">
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="">Image</label><br>
                                                <input type="hidden" class="form-control rounded-pill" name="product_id" value="<?= $p['product_id'] ?>">
                                                <input type="file" class="form-control rounded-pill" accept="image/*" name="image_product" id="preview_gambar">
                                                <?= form_error('image_product', '<div class="text-danger">', '</div>') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="section-title">List Image</h2>
        <p class="section-lead">
            <?= $p['product_name'] ?>
        </p>
    <?php endforeach; ?>
    <div class="row">
        <?php if (!$image) { ?>
            <div class="col-12 col-md-6 col-lg-12 text-center">
                <div class="card p-5">
                    <h5>No Image Available</h5>
                </div>
            </div>
        <?php } ?>
        <?php foreach ($image as $i) : ?>
            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card card-primary">
                    <div class="card-body p-3">
                        <div class="text-center mb-1">
                            <img class="img-thumbnail img-fluid" src="<?= base_url() ?>assets/img/uploads/<?= $i['image_name'] ?>" height="150px" weight="100px" alt="">
                            <strong><?= $i['image_name'] ?></strong>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end ">
                                <button data-toggle="modal" data-target="#deleteImageModal<?= $i['image_id'] ?>" class=" btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

    <!-- Modal Add Image Product-->
    <!-- <div class="modal fade" id="addImageProductModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Image Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<php echo base_url('admin/product_controller/addImageProduct'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product</label><br>
                        <select class="form-control rounded-pill" name="product_id" name="product_id" id="">
                            <php foreach ($product as $p) : ?>
                                <option name="product_id" value="<= $p['product_id'] ?>"><= $p['product_name'] ?></option>
                            <php endforeach; ?>
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

</div> -->