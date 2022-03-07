<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/pesanan_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pesanan Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/pesanan_controller/index">Data Pesanan</a></div>
                <div class="breadcrumb-item">Pesanan Detail</div>
            </div>
        </div>


        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <?php foreach ($orders as $o) : ?>
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #<?= $o['orders_code'] ?></div>
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
            <?php endforeach; ?>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
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
                            <div class="section-title">Shipping Method</div>
                            <p class="section-lead">The shipping method: <?= $op['shipping_method'] ?>.</p>
                            <!-- <div class="d-flex">
                                <div class="mr-2 bg-visa" data-width="61" data-height="38"></div>
                                <div class="mr-2 bg-jcb" data-width="61" data-height="38"></div>
                                <div class="mr-2 bg-mastercard" data-width="61" data-height="38"></div>
                                <div class="bg-paypal" data-width="61" data-height="38"></div>
                            </div> -->
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">Rp. <?= number_format($op['grand_total'], 2, ',', ',') ?></div>
                            </div>
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Shipping</div>
                                <div class="invoice-detail-value">Rp. <?= number_format($op['tax'], 2, ',', ',') ?></div>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">Rp. <?= number_format($op['total_bayar'], 2, ',', ',') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                    <!-- <a class="btn btn-primary btn-icon icon-left" href="<?= base_url() ?>admin/pesanan_controller/exportPdf/<= $orders[0]['orders_code'] ?>"><i class="fas fa-file"></i> Export PDF</a> -->
                    <!-- <a href="<?= base_url() ?>admin/pesanan_controller//<?= $orders[0]['orders_code'] ?>" class=" btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a> -->
                </div>
                <?php echo form_open('admin/pesanan_controller/printDetailPesanan');
                echo form_hidden('orders_code', $orders[0]['orders_code']);
                ?>


                <div class="text-md-right no-print">
                    <button type="submit" class="btn btn-warning btn-icon icon-left text-light"><i class="fas fa-print"></i> Print</button>
                </div>
                <?php echo form_close() ?>
                <!-- <button type="submit" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button> -->
            </div>
        </div>
</div>

</section>
</div>

</div>