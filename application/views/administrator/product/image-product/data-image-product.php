<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/product_controller" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>dashboard_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url() ?>admin/product_controller/index">Products</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <!-- DataTables Product -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col m-0 font-weight-bold text-primary">Data Tables Product</h6>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Cover</th>
                                <th>Total Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Cover</th>
                                <th>Total Image</th>
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
                                    <td><img class="img-fluid" width="200px" src="<?= base_url('assets/img/uploads/' . $p['image_product']); ?>" alt=""></td>
                                    <td class="text-center "><span class="badge badge-info"><?= $p['total_image'] ?></span></td>
                                    <td>
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