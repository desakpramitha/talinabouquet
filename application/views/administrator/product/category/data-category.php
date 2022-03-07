<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data Products</a></div>
                <div class="breadcrumb-item">Category</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Category</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>News</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Reports</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            47
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- DataTables Category -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col m-0 font-weight-bold text-primary">Data Tables Category</h6>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i> Add Category</button>
                </div>

            </div>

            <div class="ml-4 mr-4">
                <?= $this->session->flashdata('message'); ?>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Cover</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Cover</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($category as $cty) : ?>
                                <tr>
                                    <td class="text-center"><?= $i++ ?></td>
                                    <td><?= $cty['category_id'] ?></td>
                                    <td><?= $cty['category_name'] ?></td>
                                    <td><a data-toggle="modal" data-target="#imageCategoryModal<?= $cty['category_id'] ?>"><img src="<?= base_url() ?>assets/img/category/<?= $cty['category_image'] ?>" width="100px" alt=""></a></td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editCategoryModal<?= $cty['category_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit Category"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal<?= $cty['category_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Delete Category"><i class="fas fa-trash"></i></button>
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

<!-- Modal Add Category-->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/category_controller/addCategory/'); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" class="form-control rounded-pill" required placeholder="Enter Category name">
                        <div class="invalid-feedback">
                            Please fill in category name
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <img class="img-thumbnail" src="<?= base_url() ?>assets/img/no-image.png" id="gambar_load" alt="">
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="">Cover</label>
                                <input type="file" name="image" id="preview_gambar" accept="image/*" class="form-control rounded-pill" required>
                                <div class="invalid-feedback">
                                    Please insert category image
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Category-->
<?php foreach ($category as $cty) : ?>
    <div class="modal fade" id="editCategoryModal<?= $cty['category_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit Data Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/category_controller/updateCategory/'); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Category ID</label>
                            <input type="text" name="category_id" value="<?= $cty['category_id'] ?>" class="form-control rounded-pill" readonly placeholder="Enter Category name">
                        </div>
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="category_name" value="<?= $cty['category_name'] ?>" class="form-control rounded-pill" required placeholder="Enter Category name">
                            <div class="invalid-feedback">
                                Please fill in category name
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <img class="img-thumbnail" src="<?= base_url() ?>assets/img/category/<?= $cty['category_image'] ?>" id="image_load1" alt="">
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="">Cover</label>
                                    <input type="file" name="image" id="preview_image1" accept="image/*" class="form-control rounded-pill">
                                    <div class="invalid-feedback">
                                        Please insert category image
                                    </div>
                                </div>
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
<?php endforeach; ?>

<!-- Modal Delete Category-->
<?php foreach ($category as $cty) : ?>
    <div class="modal fade" id="deleteCategoryModal<?= $cty['category_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Delete Data Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(''); ?>admin/category_controller/deleteCategory/<?= $cty['category_id'] ?>" method="post">
                        Are you sure to delete <span class=" badge badge-danger"><?= $cty['category_id'] ?> <?= $cty['category_name'] ?></span>?
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

<!-- Modal View Image-->
<?php foreach ($category as $cty) : ?>
    <div class="modal fade" id="imageCategoryModal<?= $cty['category_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="<?= base_url() ?>assets/img/category/<?= $cty['category_image'] ?>" alt="">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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

<script>
    function bacaGambar1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_image").change(function() {
        bacaGambar1(this);
    })
</script>

<script>
    function bacaGambar1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_load1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_image1").change(function() {
        bacaGambar1(this);
    })
</script>