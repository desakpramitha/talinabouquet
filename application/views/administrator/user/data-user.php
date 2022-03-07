<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <!-- <div class="breadcrumb-item"><a href="#">Data Users</a></div> -->
                <div class="breadcrumb-item">Users</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Admin</h4>
                        </div>
                        <div class="card-body">
                            <?= $roleUser['admin'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <?= $roleUser['pelanggan'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Active Users</h4>
                        </div>
                        <div class="card-body">
                            <?= $statusUser['active'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Nonactive Users</h4>
                        </div>
                        <div class="card-body">
                            <?= $statusUser['nonactive'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables Users -->
        <div class="card shadow mb-4">
            <div class="row card-header py-3">
                <h6 class="col m-0 font-weight-bold text-primary">Data Tables Users</h6>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus"></i> Add User</button>
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <?php if (!validation_errors()) : ?>

            <?php else : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> add user.
                    <?= validation_errors() ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role ID</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role ID</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($users as $usr) : ?>
                                <!-- <php $start = 1; ?> -->
                                <tr>
                                    <!-- <td class="text-center"><= $start++ ?></td> -->
                                    <td><?= $usr['user_id'] ?></td>
                                    <td><?= $usr['name'] ?></td>
                                    <td><?= $usr['email'] ?></td>
                                    <td><?= $usr['role_name'] ?></td>
                                    <td>
                                        <?php if ($usr['is_active'] == 1) {
                                            $status = 'Active';
                                        } else if ($usr['is_active'] == 0) {
                                            $status = 'Nonactive';
                                        } ?>
                                        <?= $status ?>
                                    </td>
                                    <td colspan="3">
                                        <button class="btn btn-info btn-circle" data-toggle="modal" data-target="#viewUserModal<?= $usr['user_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="View User"><i class="fas fa-eye"></i></button>
                                        <!-- <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editUserModal<?= $usr['user_id'] ?>"><i class="fas fa-edit"></i></button> -->
                                        <a class="btn btn-warning btn-circle" href="<?= base_url(); ?>admin/user_controller/editUser/<?= $usr['user_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit User"><i class="fas fa-edit"></i></a>
                                        <?php if ($usr['role_id'] == 1) : ?>
                                        <?php elseif ($usr['role_id'] == 2) : ?>
                                            <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteUserModal<?= $usr['user_id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Delete User"><i class="fas fa-trash"></i></button>
                                        <?php endif ?>
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

<!-- Modal Add user-->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(''); ?>admin/user_controller/addUser/" method="post">
                    <input type="hidden" name="user_id" class="form-control rounded-pill">
                    <div class="form-group">
                        <label class="font-weight-bold" for="name">User Name</label>
                        <input type="text" name="name" class="form-control rounded-pill" placeholder="Enter Name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="email">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill" placeholder="Enter Email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="password">Password</label>
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control rounded-pill" id="exampleInputPassword" placeholder="Password">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="repeatPassword" class="form-control rounded-pill" id="exampleRepeatPassword" placeholder="Repeat Password">
                                <?= form_error('repeatPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="address">Address</label>
                        <input type="text" name="address" class="form-control rounded-pill" placeholder="Enter Address">
                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="phone">Phone Number</label>
                        <input type="tel" name="phone" class="form-control rounded-pill" placeholder="Enter Phone Number">
                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="role">Role</label>
                            <select class="form-control rounded-pill" name="role_id" value="<?= $r['role_id'] ?>" id="role">
                                <option value="">Choose Role</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('role_id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="">Status User</label>
                            <select class="form-control rounded-pill" name="is_active" id="status">
                                <option value="">Choose Status </option>
                                <option name="is_active" value="0">Nonactive</option>
                                <option name="is_active" value="1">Active</option>
                            </select>
                            <?= form_error('is_active', '<small class="text-danger pl-3">', '</small>'); ?>
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

<!-- Modal View User-->
<?php foreach ($users as $usr) : ?>
    <div class="modal fade" id="viewUserModal<?= $usr['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Detail Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <img class="img-profile img-fluid" src="<?= base_url('assets/img/profile/') . $usr['image']; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <h5><b>User Detail</b></h5><br>
                            <div class="row">
                                <dt class="col-sm-4">User ID</dt>
                                <dd class="col-sm-8"><?= $usr['user_id'] ?></dd>

                                <dt class="col-sm-4">Name</dt>
                                <dd class="col-sm-8"><?= $usr['name'] ?></dd>

                                <dt class="col-sm-4">Address</dt>
                                <dd class="col-sm-8"><?= $usr['address'] ?></dd>

                                <dt class="col-sm-4">Phone</dt>
                                <dd class="col-sm-8"><?= $usr['phone'] ?></dd>

                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8"><?= $usr['email'] ?></dd>

                                <dt class="col-sm-4">Role</dt>
                                <dd class="col-sm-8"><?= $usr['role_name'] ?></dd>

                                <dt class="col-sm-4">Status </dt>
                                <dd class="col-sm-8">
                                    <?php if ($usr['is_active'] == 1) {
                                        echo $status = 'Active';
                                    } else if ($usr['is_active'] == 0) {
                                        echo $status = 'Nonactive';
                                    } ?>

                                </dd>
                            </div>
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

<!-- Modal Edit User-->
<?php foreach ($users as $usr) : ?>
    <div class="modal fade" id="editUserModal<?= $usr['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url(''); ?>admin/user_controller/updateUser/<?= $usr['user_id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Foto Profil</label>

                                    <img class="img-profile img-fluid" src="<?= base_url('assets/img/profile/') . $usr['image']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <input type="hidden" name="user_id" value="<?= $usr['user_id'] ?>" class="form-control rounded-pill">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">User Name</label>
                                    <input type="text" name="name" value="<?= $usr['name'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Email</label>
                                    <input type="text" name="email" value="<?= $usr['email'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Address</label>
                                    <input type="text" name="address" value="<?= $usr['address'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter User name">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Phone Number</label>
                                    <input type="text" name="phone" value="<?= $usr['phone'] ?>" class="form-control rounded-pill" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter User name">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="font-weight-bold" for="">Password</label>
                                        <input type="password" name="password" class="form-control form-control-user rounded-pill" id="exampleInputPassword" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-bold" for="">Repeat Password</label>
                                        <input type="password" name="repeatPassword" class="form-control form-control-user rounded-pill" id="exampleRepeatPassword" placeholder="Repeat Password">
                                        <?= form_error('repeatPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label class="font-weight-bold" for="">Role</label>
                                        <select class="form-control rounded-pill" name="role_id" value="<?= $r['role_id'] ?>" id="exampleFormControlSelect1">
                                            <option value=<?= $usr['role_id'] ?> read-only><?= $usr['role_name'] ?></option>
                                            <?php foreach ($role as $r) : ?>
                                                <option name="role_id" value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label class="font-weight-bold" for="">Status Active</label>
                                        <?php if ($usr['is_active'] == 1) {
                                            $status = 'Active';
                                        } else if ($usr['is_active'] == 0) {
                                            $status = 'Nonactive';
                                        } ?>
                                        <select class="form-control rounded-pill" value="<?= $usr['is_active'] ?>" name="is_active" id="exampleFormControlSelect1">
                                            <option value="<?= $usr['is_active'] ?>" name="is_active" read-only><?= $status ?></option>
                                            <option name="is_active" value="0">Nonactive</option>
                                            <option name="is_active" value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="">Image</label>
                                    <input type="file" name="image" class="form-control rounded-pill">
                                </div>
                                <div class="form-group">
                                    <label for="">Since <?= date('d M Y', $usr['date_created']) ?></label><br>
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
<?php endforeach; ?>

<!-- Modal Delete User-->
<?php foreach ($users as $usr) : ?>
    <div class="modal fade" id="deleteUserModal<?= $usr['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-danger" id="exampleModalLabel">Delete Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url(''); ?>admin/user_controller/deleteUser/<?= $usr['user_id'] ?>" method="post">
                        Are you sure to delete <span class=" badge badge-danger"><?= $usr['user_id'] ?> <?= $usr['name'] ?></span>?
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