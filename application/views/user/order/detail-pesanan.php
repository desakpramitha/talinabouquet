<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $title ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>user/order_controller/myOrders">My Orders</a></li>
                    <li class="breadcrumb-item text-white"><a href="#"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Main Content -->
<div class="main-content">
    <section class="section" style="background-color:white">
        <div class="container">
            <?php foreach ($orders as $o) : ?>

                <div class="invoice mt-5 mb-5">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col">
                                        <h1><strong>Invoice</strong></h1>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <h3><strong> #<?= $o['orders_code'] ?></strong></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            <?= $o['name'] ?><br>
                                            <?= $o['phone'] ?><br>
                                            <?= $o['address'] ?><br>
                                            <?= $o['email'] ?><br>

                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Shipped To:</strong><br>
                                            <?= $o['pelanggan_name'] ?><br>
                                            <?= $o['pelanggan_phone'] ?><br>
                                            <?= $o['pelanggan_address'] ?>, <?= $o['kecamatan'] ?>, <?= $o['kabupaten'] ?>, Bali<br>
                                            <?= $o['kode_pos'] ?>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Shipping Method:</strong><br>
                                            <?= $o['shipping_method'] ?><br>
                                            Lokasi : <?= $o['lokasi'] ?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            <?= date('l, d F Y', strtotime($o['date_order'])) ?><br><br>
                                            <strong>Order Date Due:</strong><br>
                                            <?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?><br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h3>Order Summary</h3>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <thead>

                                        <th data-width="40">#</th>
                                        <th>Image</th>
                                        <th>Item</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right">Totals</th>

                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_product as $op) : ?>
                                            <tr>
                                                <td>1</td>
                                                <td><img src="<?= base_url() ?>assets/img/uploads/<?= $op['image_product'] ?>" alt="" width="60"></td>
                                                <td class="font-weight-600"><?= $op['product_name'] ?></td>
                                                <td class="font-weight-600 text-center"><?= $op['qty'] ?></td>
                                                <td class="font-weight-600 text-right">Rp. <?= number_format($op['price'], 2, ',', ',') ?></td>
                                                <td class="font-weight-600 text-right">Rp <?= number_format($op['qty'] * $op['price'], 2, ',', ',') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="section-title"><strong>Shipping Method</strong></div>
                                    <p class="section-lead">The shipping method: <?= $op['shipping_method'] ?>.</p>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><strong>Subtotal</strong></div>
                                        <div class="invoice-detail-value">Rp. <?= number_format($op['grand_total'], 2, ',', ',') ?></div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><strong>Shipping</strong></div>
                                        <div class="invoice-detail-value">Rp. <?= number_format($op['tax'], 2, ',', ',') ?></div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><strong>Total</strong></div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">Rp. <?= number_format($op['total_bayar'], 2, ',', ',') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <?php
                        echo form_open('user/order_controller/printDetailOrder');
                        echo form_hidden('orders_code', $orders[0]['orders_code']);
                        ?>

                        <div class="text-md-left no-print">
                            <button type="submit" class="btn btn-warning btn-icon icon-left text-light">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>

                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="invoice mt-5 mb-5">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col">
                                        <h1><strong>Bukti Pembayaran</strong></h1>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <img class="img-thumbnail" src="<?= base_url() ?>assets/img/confirm_payments/<?= $o['bukti_bayar_image'] ?>" width="300px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr>



        </div>
    </section>
</div>