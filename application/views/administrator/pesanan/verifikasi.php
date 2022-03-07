<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?= base_url(); ?>admin/pesanan_controller/index" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url(); ?>admin/pesanan_controller/index">Data Pesanan</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-5 col-sm-12">
                    <?php foreach ($orders as $o) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Pemesan</h4>
                                <div class="card-header-action">
                                    <h5 class="badge badge-primary"><?= $o['orders_code'] ?></h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col d-flex justify-content-center">
                                            <img src="<?= base_url() ?>assets/img/profile/<?= $o['image'] ?>" alt="image user" width="50px"><br>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-3 d-flex justify-content-center">
                                        <h6><?= $o['name'] ?></h6>
                                    </div>
                                </div>

                                <dl class="row">
                                    <dt class="col-sm-5">Nama Pemesan</dt>
                                    <dd class="col-sm-7"><?= $o['pelanggan_name'] ?></dd>

                                    <dt class="col-sm-5">Alamat Pemesan</dt>
                                    <dd class="col-sm-7"><?= $o['pelanggan_address'] ?></dd>

                                    <dt class="col-sm-5">Telepon Pemesan</dt>
                                    <dd class="col-sm-7"><?= $o['pelanggan_phone'] ?></dd>

                                    <dt class="col-sm-5">Tanggal Pesan</dt>
                                    <dd class="col-sm-7"><?= date('l, d F Y', strtotime($o['date_order'])) ?></dd>

                                    <dt class="col-sm-5">Tanggal Pengiriman</dt>
                                    <dd class="col-sm-7"><?= date(" l, d F Y", strtotime($o['date_pengiriman'])) ?></dd>
                                </dl>
                            <?php endforeach ?>
                            </div>
                        </div>

                </div>

                <div class="col-12 col-md-7 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if ($o['status_bayar'] == 0) : ?>
                                <h4>Status Pemesanan</h4>
                                <div class="card-header-action">
                                    <h5 class="badge badge-danger">Belum bayar</h5>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="row p-3">
                                <h3>Belum Melakukan Pembayaran</h3>
                            </div>
                        </div>
                    <?php else : ?>
                        <h4>Status Pemesanan</h4>
                        <div class="card-header-action">
                            <h5 class="badge badge-success">Sudah bayar</h5>
                            <h5 class="badge badge-warning">Belum diverifikasi</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php foreach ($orders as $o) : ?>
                            <div class="row">
                                <div class="col">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="">Atas Nama</label>
                                            <input class="form-control form-control-sm " value="<?= $o['account_name'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nomor Rekening</label>
                                            <input class="form-control form-control-sm " value="<?= $o['account_number'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea class="form-control" id="" cols="30" rows="10" value="<?= $o['note_payment'] ?>" readonly><?= $o['note_payment'] ?></textarea>
                                        </div>

                                </div>
                                <div class="col">
                                    <a data-toggle="modal" data-target="#imageModal<?= $o['orders_code'] ?>"><img class="img-fluid" src="<?= base_url() ?>assets/img/confirm_payments/<?= $o['bukti_bayar_image'] ?>" alt="image user"></a>
                                </div>
                            </div>
                            <div class="row">
                                <a class="btn btn-block btn-danger text-white" data-toggle="modal" data-target="#verifikasi<?= $o['orders_code'] ?>">Verifikasi</a>
                                <a class="btn btn-block btn-warning text-white" data-toggle="modal" data-target="#verifikasiCancelModal<?= $o['orders_code'] ?>">Tidak Valid</a>
                            </div>

                            </form>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Pop up image-->
<?php foreach ($orders as $o) : ?>
    <div class="modal fade" id="imageModal<?= $o['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <img src="<?= base_url() ?>assets/img/confirm_payments/<?= $o['bukti_bayar_image'] ?>" width="300px" alt="image user">
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

<!-- Modal verifikasi-->
<?php foreach ($orders as $o) : ?>
    <div class="modal fade" id="verifikasi<?= $o['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>admin/pesanan_controller/prosesVerifikasi/<?= $o['orders_code'] ?>" method="post">
                    <div class="modal-body">
                        <h6>Are you sure this payment slip is valid?</h6>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/confirm_payments/<?= $o['bukti_bayar_image'] ?>" width="100px" alt="image user">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Batal Verifikasi-->
<?php foreach ($orders as $o) : ?>
    <div class="modal fade" id="verifikasiCancelModal<?= $o['orders_code'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <h6>Are you sure this payment slip is not valid?</h6>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <img src="<?= base_url() ?>assets/img/confirm_payments/<?= $o['bukti_bayar_image'] ?>" width="100px" alt="image user">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>