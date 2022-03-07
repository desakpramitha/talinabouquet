<!-- Main Content -->
<?php foreach ($product as $p) : ?>
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
                <div class="p-4 card">
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?php echo base_url('admin/product_controller/updateProduct'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="" value="<?= $p['product_id'] ?>">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="product_name" class="form-control rounded-pill" id="" value="<?= $p['product_name'] ?>" placeholder="Enter product name">
                                <?= form_error('product_name', '<div class="text-danger">', '</div>') ?>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="">Category</label>
                                    <select class="form-control rounded-pill" name="category_id" value="<?= $p['category_id'] ?>" id="category">
                                        <option value="<?= $p['category_id'] ?>"><?= $p['category_name'] ?></option>
                                        <?php foreach ($category as $c) : ?>
                                            <option value="<?= $c['category_id'] ?>"><?= $c['category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('category_id', '<div class="text-danger">', '</div>') ?>
                                </div>
                                <div class="col form-group">
                                    <label for="">Price</label>
                                    <input type="number" class="form-control rounded-pill" name="price" value="<?= $p['price'] ?>" id="exampleInputPassword" placeholder="Enter price">
                                    <?= form_error('price', '<div class="text-danger">', '</div>') ?>
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
                                    <?php if (!$p['image_product']) { ?>
                                        <img class="img-thumbnail" src="<?= base_url() ?>assets/img/no-image.png" id="gambar_load" alt="">
                                    <?php } ?>
                                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/uploads/<?= $p['image_product'] ?>" id="gambar_load" alt="">
                                    <p><?= $p['image_product'] ?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                    </div>
                    </form>
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

<!-- Modal Add Image Product-->
<div class="modal fade" id="addImageProductModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Image Product</h5>
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

</div>