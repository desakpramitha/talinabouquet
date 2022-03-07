<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/laporan_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/laporan_controller/index">Laporan</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>


        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- <php foreach ($orders as $o) : ?> -->
                        <div class="invoice-title">
                            <h4><?= $title ?></h4>
                            <div class="invoice-number"> Tahun <?= $tahun ?>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="section-title">Order Summary</div>
                        <p class="section-lead">All items here cannot be deleted.</p> -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <th data-width="40">#</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Totals</th>

                                </thead>
                                <tbody>
                                    <?php if (!$laporan) { ?>
                                        <td class="alert alert-danger text-center" colspan="8">
                                            Data not found
                                        </td>
                                    <?php } else { ?>

                                        <?php
                                        $no = 1;
                                        $grandTotal = 0;
                                        foreach ($laporan as $lp) :
                                            $total = $lp['qty'] * $lp['price'];
                                            $grandTotal = $grandTotal + $total; ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $lp['orders_code'] ?></td>
                                                <td><?= date('d F Y', strtotime($lp['date_order'])) ?></td>
                                                <td><img src="<?= base_url() ?>assets/img/uploads/<?= $lp['image_product'] ?>" alt="" width="60"></td>
                                                <td class="font-weight-600">
                                                    <?= $lp['product_name'] ?>
                                                </td>
                                                <td class="font-weight-600 text-center">
                                                    <?= $lp['qty'] ?>
                                                </td>
                                                <td class="font-weight-600 text-right">Rp. <?= number_format($lp['price'], 2, ',', ',') ?>
                                                </td>
                                                <td class="font-weight-600 text-right">Rp <?= number_format($lp['qty'] * $lp['price'], 2, ',', ',') ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-12 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Grand Total</div>
                                    <?php if (!$laporan) { ?>
                                        <div class="invoice-detail-value">Rp. 0 </div>
                                    <?php } else { ?>
                                        <div class="invoice-detail-value">Rp. <?= number_format($grandTotal, 2, ',', ',') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php echo form_open('admin/laporan_controller/printLaporanTahunan');
                    echo form_hidden('tahun', $tahun);
                    ?>

                    <div class="text-md-right no-print">
                        <button type="submit" class="btn btn-warning btn-icon icon-left text-light"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

    </section>
</div>

</div>