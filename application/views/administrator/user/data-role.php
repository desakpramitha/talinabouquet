<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data Users</a></div>
                <div class="breadcrumb-item">Role</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Role</h4>
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
        <!-- DataTables Role -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col m-0 font-weight-bold text-primary">Data Tables Role</h6>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addRoleModal"><i class="fas fa-plus"></i> Add Role</button>
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($role as $r) : ?>
                                <?php $start = 1; ?>
                                <tr>
                                    <td class="text-center"><?= $start++ ?></td>
                                    <td><?= $r['role_id'] ?></td>
                                    <td><?= $r['role_name'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editRoleModal<?= $r['role_id'] ?>"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteRoleModal<?= $r['role_id'] ?>"><i class="fas fa-trash"></i></button>
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
<!-- Modal Add Role-->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/user_controller/addRole/'); ?>" method="POST">
                    <div class="form-group">
                        <label for="">Role Name</label>
                        <input type="text" name="role_name" class="form-control rounded-pill" id="" aria-describedby="" placeholder="Enter role name">
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

<!-- Modal Edit Role-->
<?php foreach ($role as $r) : ?>
    <div class="modal fade" id="editRoleModal<?= $r['role_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit Data Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('admin/user_controller/updateRole/'); ?>" method="POST">
                        <div class="form-group">
                            <label for="">Role ID</label>
                            <input type="text" name="role_id" value="<?= $r['role_id'] ?>" class="form-control rounded-pill" readonly placeholder="Enter role name">
                        </div>
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input type="text" name="role_name" value="<?= $r['role_name'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Category name">
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

<!-- Modal Delete Role-->
<?php foreach ($role as $r) : ?>
    <div class="modal fade" id="deleteRoleModal<?= $r['role_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Delete Data Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(''); ?>admin/user_controller/deleteRole/<?= $r['role_id'] ?>" method="post">
                        Are you sure to delete <span class=" badge badge-danger"><?= $r['role_id'] ?> <?= $r['role_name'] ?></span>?
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
<!-- End of Main Content -->