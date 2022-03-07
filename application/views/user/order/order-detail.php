<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $title ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item text-white"><a href="#"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <!-- <div class="row"> -->
        <div class="col-sm-10 mb-3">
            <h1><b>Terima kasih atas Pesanan Anda</b></h1>
        </div>

        <div class="col-md-10 col-lg-10">
            <div class="order-box mt-5">
                <div class="title-left">
                    <h3>Your order</h3>
                </div>
                <?php foreach ($order as $o) : ?>
                    <div class="d-flex">
                        <div class="font-weight-bold">Product</div>
                        <div class="ml-auto font-weight-bold">Total</div>
                    </div>
                    <hr class="my-1">

                    <?php if (!$orders) { ?>
                        <td class="text-center" colspan="7">
                            <h4><strong>Empty</h5>
                        </td>
                    <?php } else { ?>
                        <?php $i = 1; ?>
                        <?php foreach ($orders as $items) : ?>
                            <div class="rounded p-2 bg-light">
                                <div class="media mb-2 border-bottom">
                                    <div class="media-body">
                                        <a href="#">
                                            <img class="img-fluid" src="<?= base_url() ?>assets/img/uploads/<?= $items['image_product'] ?>" width="50px" alt="" />
                                        </a>
                                        <a href="detail.html"> <?= $items['product_name'] ?></a>
                                        <div class="small text-muted">Price: Rp. <?= number_format($items['price'], 2, ",", ".") ?> <span class="mx-2">|</span> Qty: <?= $items['qty'] ?> <span class="mx-2">|</span> Subtotal: Rp. <?= number_format($items['price'] * $items['qty'], 2, ",", "."); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    <?php } ?>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold" name="total"> Rp. <?= number_format($o['grand_total'], 2, ",", "."); ?></div>
                    </div>

                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold" id="shipping_cost"> Rp. <?= number_format($orders[0]['tax'], 2, ",", "."); ?> </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5" id="grand_total"> Rp. <?= number_format($o['total_bayar'], 2, ",", "."); ?> </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-sm-10 mt-5">
            <div class="title-left">
                <h3>Segera Lakukan pembayaran sesuai dengan total pesanan Anda, ke rekening kami di bawah ini:</h3>
            </div>
            <div class="col-sm-10">
                <div class="media">
                    <dl class="row">
                        <dd class="col-sm-5">Nama Bank</dd>
                        <dt class="col-sm-5">Bank BNI</dt>

                        <dd class="col-sm-5">Nama Pemilik</dd>
                        <dt class="col-sm-5">Ni Made Prilia Hayu</dt>

                        <dd class="col-sm-5">Nomor Rekening</dd>
                        <dt class="col-sm-5">070070337</dt>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-sm-10 mt-3">
            <h3>Setelah Anda menyelesaikan pembayaran, pastikan untuk melakukan konfirmasi pada halaman berikut: </h3>
        </div>
        <div class="col-sm-10 mt-4">
            <div class="d-flex justify-content-center ">
                <a class="btn btn-lg hvr-hover text-white" href="<?= base_url() ?>user/order_controller/konfirmasiBayar/<?= $order[0]['orders_code'] ?>">KLIK DI SINI <br> KONFIRMASI PEMBAYARAN</a>
            </div>
        </div>


    </div>
</div>


</div>
<!-- End Cart -->