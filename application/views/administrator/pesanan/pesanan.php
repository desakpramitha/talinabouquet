<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesanan Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item">Pesanan</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum Diproses</h4>
                        </div>
                        <div class="card-body">
                            <?= $countStatus['unpaid'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Dalam proses</h4>
                        </div>
                        <div class="card-body">
                            <?= $countStatus['proses'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Siap antar</h4>
                        </div>
                        <div class="card-body">
                            <?= $countStatus['siap_antar'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Complete</h4>
                        </div>
                        <div class="card-body">
                            <?= $countStatus['complete'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables Pesanan -->
        <div class="card shadow p-4">
            <?= $this->session->flashdata('message'); ?>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true"><b>Orders</b></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab" aria-controls="proses" aria-selected="false">Diproses</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Siap antar</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if (!$orders) : ?>
                                            <td colspan="3">
                                                No data available
                                            </td>
                                        <?php else : ?>
                                            <?php foreach ($orders as $o) : ?>
                                                <tr>
                                                    <td><a href="<?= base_url() ?>admin/pesanan_controller/detailPesanan/<?= $o['orders_code'] ?>"><?= $o['orders_code'] ?></a></td>
                                                    <td class="font-weight-600"><?= $o['pelanggan_name'] ?></td>
                                                    <td>
                                                        <?php if ($o['status_bayar'] == 0) : ?>
                                                            <div class="badge badge-warning">Belum Bayar</div>
                                                        <?php else : ?>
                                                            <div class="badge badge-success mb-1">Sudah Bayar</div><br>
                                                            <div class="badge badge-primary">Menunggu Verifikasi</div>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?></td>
                                                    <td>
                                                        <!-- <a href="<= base_url() ?>admin/pesanan_controller/detailPesanan/<?= $o['orders_code'] ?>" class="btn btn-primary">Detail</a> -->
                                                        <?php if ($o['status_bayar'] == 0) : ?>
                                                            <button data-toggle="modal" data-target="#pesananCancelModal<?= $o['orders_code'] ?>" class="btn btn-primary"><i class="fas fa-times"></i> Cancel</button>
                                                        <?php endif ?>
                                                        <?php if ($o['status_bayar'] == 1) : ?>
                                                            <a href="<?= base_url() ?>admin/pesanan_controller/verifikasi/<?= $o['orders_code'] ?>" class="btn btn-danger">Verifikasi</a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if (!$diproses) : ?>
                                            <td colspan="3">
                                                No data available
                                            </td>
                                        <?php else : ?>
                                            <?php foreach ($diproses as $o) : ?>
                                                <tr>
                                                    <td><a href="<?= base_url() ?>admin/pesanan_controller/detailPesanan/<?= $o['orders_code'] ?>"><?= $o['orders_code'] ?></a></td>
                                                    <td class="font-weight-600"><?= $o['pelanggan_name'] ?></td>
                                                    <td>
                                                        <div class="badge badge-primary">Pesanan Diproses</div>
                                                    </td>
                                                    <td><?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>admin/pesanan_controller/pesananselesai/<?= $o['orders_code'] ?>" class="btn btn-danger">Siap Antar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                            <th>Actions</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if (!$selesai) : ?>
                                            <td colspan="3">
                                                No data available
                                            </td>
                                        <?php else : ?>
                                            <?php foreach ($selesai as $o) : ?>
                                                <tr>
                                                    <td><a href="<?= base_url() ?>admin/pesanan_controller/detailPesanan/<?= $o['orders_code'] ?>"><?= $o['orders_code'] ?></a></td>
                                                    <td class="font-weight-600"><?= $o['pelanggan_name'] ?></td>
                                                    <td>
                                                        <div class="badge badge-success">Pesanan Selesai</div>
                                                        <div class="badge badge-info">Proses Shipping</div>
                                                    </td>
                                                    <td><?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?></td>
                                                    <td>
                                                        <button data-toggle="modal" data-target="#pesananDiterimaModal<?= $o['orders_code'] ?>" class="btn btn-danger"><i class="fas fa-shipping-fast"></i>Terkirim</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if (!$terima) : ?>
                                            <td colspan="3">
                                                No data available
                                            </td>
                                        <?php else : ?>
                                            <?php foreach ($terima as $o) : ?>
                                                <tr>
                                                    <td><a href="#"><?= $o['orders_code'] ?></a></td>
                                                    <td class="font-weight-600"><?= $o['pelanggan_name'] ?></td>
                                                    <td>
                                                        <?php if ($o['status'] == 3) : ?>
                                                            <div class="badge badge-success">Pesanan telah diterima</div>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="section-body">
        </div>
    </section>

    <!-- Modal Pesanan terima-->
    <?php foreach ($selesai as $o) : ?>
        <div class="modal fade" id="pesananDiterimaModal<?= $o['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Order Code <span class="badge badge-danger"><?= $o['orders_code'] ?></span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url() ?>admin/pesanan_controller/pesananTerkirim/<?= $o['orders_code'] ?>" method="post">
                            <h5>Are you sure product has been delivered ?</h5>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Pesanan Cancel-->
    <?php foreach ($orders as $o) : ?>
        <div class="modal fade" id="pesananCancelModal<?= $o['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url() ?>admin/pesanan_controller/pesananCancel/<?= $o['orders_code'] ?>" method="post">
                            <h5>Are you sure to canceled <span class="badge badge-danger"><?= $o['orders_code'] ?></span> ?</h5>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>