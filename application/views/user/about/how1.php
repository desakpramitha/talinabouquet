<!-- <div class="contact-box-main"> -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <li class="text-left">
            <img src="<?= base_url(); ?>assets/img/how/11.png" alt="">
        </li>
        <li class="text-center">
            <img src="<?= base_url(); ?>assets/img/how/2.png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/3.png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/4.png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/5.png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/6(2).png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/7.png" alt="">
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/how/8.png" alt="">
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<div class="row p-5">

    <div class="col-sm-7">
        <div class="contact-form-right">
            <h2><strong>HOW TO BUY</strong></h2>
            <hr>
            <ul>
                <li class="mb-2">
                    <h4><strong>#1 Pilih Produk</strong></h4>
                    <h5>Cari dan pilih yang ingin kamu beli.</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#2 ADD TO CART</strong></h4>
                    <h5>Isi berapa banyak produk yang ingin kamu beli, kemudian klik "ADD TO CART"</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#3 Lihat CART</strong></h4>
                    <h5>Jika kamu yakin ingin membeli produk, klik “CHECKOUT”.</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#4 BILLING & SHIPPING</strong></h4>
                    <h5>
                        - Mengisi data diri dan alamat lengkap.<br>

                        – Pilih metode pengiriman<br>

                        – Klik “Place Order”, jika kamu sudah selesai mengisi semua data.</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#5 ORDER DETAILS</strong></h4>
                    <h5> Setelah kamu selesai “Place Order” Kamu akan mendapatkan “ORDER DETAILS” untuk melakukan pembayaran Anda</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#6 Konfirmasi Pembayaran</strong></h4>
                    <h5>Setelah kamu melakukan pembayaran, silakan unggah bukti pembayaran pada halaman “KONFIRMASI PEMBAYARAN” Anda dan selesaikan dengan klik “Konfirmasi Pembayaran”.</h5>
                </li>
                <li class="mb-2">
                    <h4><strong>#7 TERIMA PESANAN</strong></h4>
                    <h5>Kamu akan menerima pesananmu pada tanggal pesanan dikirim. </h5>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-sm-5 d-flex justify-content-center">
        <div class="align-self-center">
            <img class="img-fluid " src="<?= base_url() ?>assets/img/undraw_shopping_app_flsj.svg" alt="">
        </div>
    </div>
</div>

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
<!-- End Cart -->