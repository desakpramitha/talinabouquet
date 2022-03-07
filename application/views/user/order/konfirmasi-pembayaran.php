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

    <!-- Start Services  -->
    <div class="services-box-main">
        <div class="container">
            <div class="contact-form-right">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-danger">
                                <h3 class="text-white"><strong>Order Code : </strong><span class="badge badge-light">#<?= $order[0]['orders_code'] ?></span></h3>
                            </div>
                            <div class="card-body">
                                <p>Silakan transfer ke rekening <strong>BNI</strong> kami di bawah ini:</p>
                                <dl class="row">
                                    <dd class="col-sm-5">Nama Bank</dd>
                                    <dt class="col-sm-5">Bank BNI</dt>

                                    <dd class="col-sm-5">Atas Nama</dd>
                                    <dt class="col-sm-5">Ni Made Prilia Hayu</dt>

                                    <dd class="col-sm-5">No Rekening</dd>
                                    <dt class="col-sm-5">0700703337</dt>
                                </dl>
                                <hr>
                                <p>Lakukan pembayaran sesuai dengan total pesanan Anda:</p>
                                <h1 class="text-danger"><b><strong>Rp. <?= number_format($order[0]['total_bayar']) ?></strong></b></h1>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2><?= $title ?></h2>
                        <p>Hi, <b><?= $user['name'] ?></b>. Please confimation your payments order here</p>
                        <?= $this->session->flashdata('message') ?>
                        <form method="post" action="<?= base_url() ?>user/order_controller/konfirmasiBayar/<?= $order[0]['orders_code'] ?>" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            <input type="hidden" class="form-control" name="orders_code" value="<?= $order[0]['orders_code'] ?>" name="orders_code">
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="account_name" placeholder="Atas Nama">
                                <?= form_error('account_name', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="account_number" placeholder="Account Number (Optional)">
                                <?= form_error('account_number', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="note" id="note" cols="10" rows="5" placeholder="Your Description (Optional)"></textarea>
                                <?= form_error('note', '<div class="text-danger">', '</div>') ?>
                            </div>

                            <label for="bukti_bayar_image">Bukti Bayar</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <img class="img-thumbnail img-fluid" src="<?= base_url() ?>assets/img/no-image.png" id="gambar_load" height="100px" alt="">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" class="form-control" accept="image/*" id="preview_gambar" name="bukti_bayar_image">
                                        <?= form_error('bukti_bayar_image', '<div class="text-danger">', '</div>') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-button d-flex justify-content-end">
                                <button class="btn hvr-hover" id="submit" type="submit">Konfirmasi Pembayaran</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        bacaGambar(this);
    })
</script>