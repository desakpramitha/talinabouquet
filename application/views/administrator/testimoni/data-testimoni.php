<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Testimoni Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item">Testimoni</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-comments"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Testimoni</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables Testimoni -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col m-0 font-weight-bold text-primary">Data Tables Testimoni Pelanggan</h6>
                <div class="col d-flex justify-content-end">
                    <!-- <button class="btn btn-primary btn-rounded mr-3" data-toggle="modal" data-target="#addTestimoniModal"><i class="fas fa-plus"></i> Add Testimoni</button> -->
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Testimoni ID</th>
                                <th>User ID</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Testimoni ID</th>
                                <th>User ID</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($testimoni as $t) : ?>
                                <tr>
                                    <td><?= $t['testimoni_id'] ?></td>
                                    <td><?= $t['user_id'] ?></td>
                                    <td><?= $t['description'] ?></td>
                                    <td>
                                        <button class="btn btn-info btn-circle" data-toggle="modal" data-target="#viewTestimoniModal<?= $t['testimoni_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="View Testimoni"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteTestimoniModal<?= $t['testimoni_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Delete Testimoni"><i class="fas fa-trash"></i></button>
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

<!-- Modal View Testimoni-->
<?php foreach ($testimoni as $t) : ?>
    <div class="modal fade" id="viewTestimoniModal<?= $t['testimoni_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">View Data Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input readonly type="text" name="name" value="<?= $t['name'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Testimoni name">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea readonly name="description" value="<?= $t['description'] ?>" class="form-control" col="12" rows="30" placeholder="Enter Testimoni name"><?= $t['description'] ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <img class="img-fluid" src="<?= base_url() ?>assets/img/testimonials/<?= $t['image_testimoni'] ?>" alt="testimoni_pelangan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Delete Testimoni-->
<?php foreach ($testimoni as $t) : ?>
    <div class="modal fade" id="deleteTestimoniModal<?= $t['testimoni_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-danger" id="exampleModalLabel">Delete Data Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(''); ?>admin/testimoni_controller/deleteTestimoni/<?= $t['testimoni_id'] ?>" method="post">
                        Are you sure to delete <span class="badge badge-danger"><?= $t['testimoni_id'] ?></span>?
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