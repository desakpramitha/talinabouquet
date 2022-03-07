<!-- Main Content -->
<div class="main-content">
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background-image: url(<?= base_url() ?>assets/img/banner03-unsplash.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $title ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller">Home</a></li>
                        <li class="breadcrumb-item active text-white"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="services-box-main">
        <div class="container">
            <nav>
                <?= $this->session->flashdata('message') ?>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-orders-tab" data-toggle="tab" href="#nav-orders" role="tab" aria-controls="nav-orders" aria-selected="true">Orders</a>
                    <a class="nav-link" id="nav-proses-tab" data-toggle="tab" href="#nav-proses" role="tab" aria-controls="nav-proses" aria-selected="false">Diproses</a>
                    <a class="nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai" role="tab" aria-controls="nav-selesai" aria-selected="false">Pesanan Selesai</a>
                    <a class="nav-link" id="nav-shipping-tab" data-toggle="tab" href="#nav-shipping" role="tab" aria-controls="nav-shipping" aria-selected="false">Selesai</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab">
                    <div class="col-md-12 mt-5">
                        <!-- Data Pesanan belum di bayar -->
                        <div class="table-main table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!$order) : ?>
                                        <td colspan="3">
                                            No data available
                                        </td>
                                    <?php else : ?>
                                        <?php foreach ($order as $p) : ?>
                                            <tr>
                                                <td><a href="<?= base_url() ?>user/order_controller/detailOrder/<?= $p['orders_code'] ?>"><?= $p['orders_code'] ?></a></td>
                                                <td><?= date('d M Y', strtotime($p['date_order'])) ?></td>
                                                <td>
                                                    <?php if ($p['status_bayar'] == 0) : ?>
                                                        <h3>
                                                            <span class="badge badge-danger text-center">
                                                                <strong>Belum Bayar </strong>
                                                            </span>
                                                        </h3>
                                                    <?php else : ?>
                                                        <h3>
                                                            <span class="badge badge-success text-center"><strong>Sudah Bayar </strong></span>
                                                        </h3>
                                                        <h3>
                                                            <span class="badge badge-info text-center"><strong>Menunggu Verifikasi </strong></span>
                                                        </h3>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if ($p['status_bayar'] == 0) : ?>
                                                        <a class="btn btn-primary text-white" href="<?= base_url() ?>user/order_controller/konfirmasiBayar/<?= $p['orders_code'] ?>"> Konfirmasi Pembayaran</a>
                                                        <button data-toggle="modal" data-target="#orderCancelModal<?= $p['orders_code'] ?>" class="btn btn-danger text-white"><i class="fas fa-times"></i> Cancel</button>
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
                <div class="tab-pane fade" id="nav-proses" role="tabpanel" aria-labelledby="nav-proses-tab">
                    <!-- Data Pesanan diproses -->
                    <div class="col-md-12 mt-5">
                        <div class="table-main table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!$payment) : ?>
                                        <td colspan="3" class="text-center">
                                            No data available
                                        </td>
                                    <?php else : ?>
                                        <?php foreach ($payment as $p) : ?>
                                            <tr>
                                                <td><a href="<?= base_url() ?>user/order_controller/detailOrder/<?= $p['orders_code'] ?>"><?= $p['orders_code'] ?></a></td>
                                                <td><?= date('d M Y', strtotime($p['date_order'])) ?></td>
                                                <td>
                                                    <h3>
                                                        <span class="badge badge-success text-center"><strong>Terverifikasi</strong></span>
                                                    </h3>
                                                    <h3>
                                                        <span class="badge badge-info text-center"><strong>Pesanan Diproses</strong></span>
                                                    </h3>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
                    <!-- Data Pesanan sudah selesai -->
                    <div class="col-md-12 mt-5">
                        <div class="table-main table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!$ship) : ?>
                                        <td colspan="3" class="text-center">
                                            No data available
                                        </td>
                                        <?php foreach ($ship as $p) : ?>
                                            <tr>
                                                <td><?= $p['orders_code'] ?></td>
                                                <td><?= date('d M Y', strtotime($p['date_order'])) ?></td>
                                                <td>
                                                    <h3>
                                                        <span class="badge badge-success text-center"><strong>Pesanan selesai proses shipping</strong></span>
                                                    </h3>
                                                </td>
                                                <!-- <td>
                                                    <a class="btn btn-info text-white" data-toggle="modal" data-target="#pesananDiterimaModal<?= $p['orders_code'] ?>">Pesanan diterima</a>
                                                </td> -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
                    <!-- Data Pesanan -->
                    <div class="col-md-12 mt-5">
                        <div class="table-main table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!$selesai) : ?>
                                        <td colspan="3" class="text-center">
                                            No Data is available
                                        </td>
                                    <?php else : ?>
                                        <?php foreach ($selesai as $p) : ?>
                                            <tr>
                                                <td><a href="<?= base_url() ?>user/order_controller/detailOrder/<?= $p['orders_code'] ?>"><?= $p['orders_code'] ?></a></td>
                                                <td><?= date('d M Y', strtotime($p['date_order'])) ?></td>
                                                <td>
                                                    <h3>
                                                        <span class="badge badge-success text-center"><strong>Pesanan telah diterima</strong></span>
                                                    </h3>
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




        </div>
    </div>
</div>

<!-- Modal Cancel-->
<?php foreach ($order as $p) : ?>
    <div class="modal fade" id="orderCancelModal<?= $p['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Konfirmasi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>user/order_controller/orderCancel/<?= $p['orders_code'] ?>" method="post">
                        <h4>Are you sure to canceled your order <span class="badge badge-danger"><?= $p['orders_code'] ?></span> ?</h4>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>