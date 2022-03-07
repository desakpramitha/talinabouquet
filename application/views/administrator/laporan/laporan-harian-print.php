<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?> &mdash; Talina Bouquet</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/user/images/icon.png" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>vendor/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/stisla/assets/css/components.css">

    <!-- Custom styles for this page -->
    <link href="<?= base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body>
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-sm-12">
                    <!-- <php foreach ($orders as $o) : ?> -->
                    <div class="invoice-title">
                        <div class="row">
                            <div class="col-sm-2 d-flex align-self-center">
                                <img class="img-fluid" src="<?= base_url(); ?>assets/user/images/icon.png" width="150px" alt="">
                                <!-- <img src="<= base_url(); ?>assets/user/images/logo2.png" width="200px" alt=""> -->
                            </div>
                            <div class="col text-center">
                                <h3><strong>TALINA BOUQUET</strong></h3>
                                <h5>Jalan Tunjung Sari No 30, Padangsambian, Denpasar, Bali</h5>
                                <h6>Phone: +62-81239754384 | Instagram: talinabouquet | Email: talinabouquet@gmail.com</h6>
                            </div>
                        </div>
                        <hr style="height:2px;border:none;color:#333;background-color:#333;">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="invoice-number">
                            Tanggal : <= $tanggal ?>/<= $bulan ?>/<= $tahun ?>
                        </div> -->
                    <div class="section-title">
                        <h4><?= $title ?></h4>
                    </div>
                    <p class="section-lead">Tanggal : <?= $tanggal ?>/<?= $bulan ?>/<?= $tahun ?></p>

                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <thead>

                                <th data-width="40">#</th>
                                <th>Order Code</th>
                                <th>Customer Name</th>
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
                                            <td><?= $lp['pelanggan_name'] ?></td>
                                            <td><img src="<?= base_url() ?>assets/img/uploads/<?= $lp['image_product'] ?>" alt="" width="60"></td>
                                            <td class="font-weight-600">
                                                <?= $lp['product_name'] ?>
                                            </td>
                                            <td class="font-weight-600 text-center">
                                                <?= $lp['qty'] ?>
                                            </td>
                                            <td class="font-weight-600 text-right">Rp. <?= number_format($lp['price'], 2, ',', ',') ?>
                                            </td>
                                            <td class="font-weight-600 text-right">Rp <?= number_format($total, 2, ',', ',') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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
            </div>
        </div>

        <script type="text/javascript">
            window.print();
        </script>

        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="<?= base_url() ?>vendor/stisla/assets/js/stisla.js"></script>

        <!-- Template JS File -->
        <script src="<?= base_url() ?>vendor/stisla/assets/js/scripts.js"></script>
        <script src="<?= base_url() ?>vendor/stisla/assets/js/custom.js"></script>

        <!-- Page Specific JS File -->
        <script src="<?= base_url() ?>vendor/stisla/assets/js/page/index.js"></script>
        <script src="<?= base_url() ?>vendor/stisla/assets/js/page/bootstrap-modal.js"></script>
        <script src="<?= base_url() ?>vendor/stisla/assets/js/page/modules-sweetalert.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url(); ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?= base_url(); ?>assets/admin/js/demo/datatables-demo.js"></script>

</body>

</html>