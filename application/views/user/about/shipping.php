<!-- Start Contact Us  -->
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $title ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller">Home</a></li>
                    <li class="breadcrumb-item text-white"><?= $title ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- <div class="contact-box-main"> -->
<div class="row p-5">
    <div class="col-sm-5 d-flex justify-content-center">
        <div class="align-self-center">
            <img class="img-fluid " src="<?= base_url() ?>assets/img/undraw_On_the_way_re_swjt.svg" alt="">
        </div>
    </div>
    <div class="col-sm-7">
        <div class="contact-form-right ">
            <h2><strong>METODE PENGIRIMAN</strong></h2>
            <hr>
            Metode pengiriman pesanan kepada pelanggan dilakukan sesuai dengan pilihan daftar pengiriman sebagai berikut :
            <div class="table mt-2">
                <table>
                    <th><strong>Delivery</strong></th>
                    <th><strong>Lokasi<strong></th>
                    <?php foreach ($ship as $s) : ?>
                        <tr>
                            <td><?= $s['shipping_method'] ?></td>
                            <td><?= $s['lokasi'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Cart -->