<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Checkout</h2>
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
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="odr-box">
                    <div class="title-left">
                        <h3>Shopping cart</h3>
                    </div>
                    <?php
                    $contents = $this->cart->contents(); ?>
                    <?php if (!$contents) { ?>
                        <td class="text-center" colspan="7">
                            <h4><strong>Empty Cart</h5>
                        </td>
                    <?php } else { ?>
                        <?php $i = 1; ?>
                        <?php foreach ($contents as $items) : ?>
                            <div class="rounded p-2 bg-light">
                                <div class="media mb-2 border-bottom">
                                    <div class="media-body">
                                        <a href="#">
                                            <img class="img-fluid" src="<?= base_url() ?>assets/img/uploads/<?= $items['image'] ?>" width="50px" alt="" />
                                        </a>
                                        <a href="detail.html"> <?= $items['name'] ?></a>
                                        <div class="small text-muted">Price: Rp. <?= number_format($items['price'], 2, ",", ".") ?> <span class="mx-2">|</span> Qty: <?= $items['qty'] ?> <span class="mx-2">|</span> Subtotal: Rp. <?= number_format($items['subtotal'], 2, ",", "."); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>

                <form action="<?= base_url() ?>user/order_controller" method="post" class="needs-validation" novalidate>
                    <div class="shipping-method-box mt-5">
                        <div class="title-left">
                            <h3>Shipping Method</h3>
                        </div>
                        <?php $no_order = date('Ymd') . strtoupper(random_string('alnum', 8)); ?>

                        <div class="mb-4">
                            <select class="form-control" name="shipping_method" id="shipping_method">
                                <option value="">Choose shipping method</option>
                                <?php foreach ($ship as $s) : ?>
                                    <option value="<?= $s['ship_id'] ?>"><?= $s['shipping_method'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('shipping_method', '<div class="text-danger">', '</div>') ?>
                            <div id="shipping">

                            </div>
                        </div>
                    </div>
                    <div class="order-box mt-5">
                        <div class="title-left">
                            <h3>Payment Method</h3>
                        </div>

                        <ol>
                            <li>Pembayaran dilakukan dengan cara <b>TRANSFER VIA BANK</b> ke rekening Talina Bouquet dengan jumlah angka transfer sesuai yang tertera pada tagihan</li>
                            <li>Cantumkan kode pembelian pada keterangan berita transfer untuk mempermudah pengecekan</li>
                            <li>Pastikan melakukan <b>KONFIRMASI PEMBAYARAN</b> secara manual setelah melakukan Pembayaran</li>
                        </ol>
                    </div>

            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>
                            <div class="mb-3">
                                <label for="fullName">Nama Penerima *</label>
                                <input type="text" class="form-control" name="pelanggan_name" id="pelanggan_name" placeholder="" value="<?= set_value('pelanggan_name') ?>">
                                <?= form_error('pelanggan_name', '<div class="text-danger">', '</div>') ?>
                            </div>

                            <div class="mb-3">
                                <label for="fullName">Phone *</label>
                                <input type="tel" class="form-control" name="pelanggan_phone" id="pelanggan_phone" placeholder="Phone Number" value="<?= set_value('pelanggan_phone') ?>">
                                <?= form_error('pelanggan_phone', '<div class="text-danger">', '</div>') ?>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="pelanggan_address" id="pelanggan_address" placeholder="Enter Address" value="<?= set_value('pelanggan_address') ?>">
                                <?= form_error('pelanggan_address', '<div class="text-danger">', '</div>') ?>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="kabupaten">Kabupaten *</label>
                                    <select class="wide w-100" id="kabupaten" name="kabupaten">
                                        <option value="" data-display="Select">Choose...</option>
                                        <?php foreach ($kab as $kab) : ?>
                                            <option value="<?= $kab['id_kab'] ?>"><?= $kab['kabupaten'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kabupaten', '<div class="text-danger">', '</div>') ?>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="kecamatan">Kecamatan *</label>
                                    <select class="wide w-100" id="kecamatan" name="kecamatan">
                                        <option value="" data-display="Select">Choose...</option>
                                    </select>
                                    <?= form_error('kecamatan', '<div class="text-danger">', '</div>') ?>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="zip">Kode Pos *</label>
                                    <input type="text" class="form-control" name="kode_pos" id="zip" placeholder="Kode Pos" value="<?= set_value('kode_pos') ?>">
                                    <?= form_error('kode_pos', '<div class="text-danger">', '</div>') ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="">Tanggal Dikirim</label>
                                <input type="date" class="form-control" name="date_pengiriman" id="date_pengiriman" placeholder="">
                                <input type="date" class="form-control" name="date_pengiriman" id="date_pengiriman" placeholder="">
                                <input type="text" id="datepicker">
                                <?= form_error('date_pengiriman', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="mb-3">
                                <label for="note">Pesan</label><br>
                                <textarea class="wide w-100" name="note" id="note" placeholder="Enter Note"></textarea>
                                <?= form_error('note', '<div class="text-danger">', '</div>') ?>
                            </div>

                        </div>

                    </div>
                    <!-- <div class="col-md-12 col-lg-12">
                         <div class="odr-box">
                            <div class="title-left">
                                <h3>Shopping cart</h3>
                            </div>
                            <div class="rounded p-2 bg-light">
                                <div class="media mb-2 border-bottom">
                                    <div class="media-body"> <a href="detail.html"> Lorem ipsum dolor sit amet</a>
                                        <div class="small text-muted">Price: $80.00 <span class="mx-2">|</span> Qty: 1 <span class="mx-2">|</span> Subtotal: $80.00</div>
                                    </div>
                                </div>
                                <div class="media mb-2 border-bottom">
                                    <div class="media-body"> <a href="detail.html"> Lorem ipsum dolor sit amet</a>
                                        <div class="small text-muted">Price: $60.00 <span class="mx-2">|</span> Qty: 1 <span class="mx-2">|</span> Subtotal: $60.00</div>
                                    </div>
                                </div>
                                <div class="media mb-2">
                                    <div class="media-body"> <a href="detail.html"> Lorem ipsum dolor sit amet</a>
                                        <div class="small text-muted">Price: $40.00 <span class="mx-2">|</span> Qty: 1 <span class="mx-2">|</span> Subtotal: $40.00</div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> -->
                    <div class="col-md-12 col-lg-12">
                        <div class="order-box mt-5">
                            <div class="title-left">
                                <h3>Your order</h3>
                            </div>
                            <div class="d-flex">
                                <div class="font-weight-bold">Product</div>
                                <div class="ml-auto font-weight-bold">Total</div>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto font-weight-bold" name="total"> Rp. <?= number_format($this->cart->total(), 2, ",", "."); ?></div>
                            </div>

                            <div class="d-flex">
                                <h4>Shipping Cost</h4>
                                <div class="ml-auto font-weight-bold" id="shipping_cost"> 0</div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5" id="grand_total"> Rp. <?= number_format($this->cart->total(), 2, ",", "."); ?> </div>

                            </div>
                            <input type="date" class="form-control" name="date_pengiriman" id="date_pengiriman" placeholder="">
                            <input type="text" id="datepicker">
                            <input type="hidden" class="form-control" name="no_order" id="no_order" placeholder="" value="<?= $no_order ?>">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="" value="<?= $user['user_id'] ?>">
                            <input type="hidden" class="form-control" name="total" placeholder="" value="<?= $this->cart->total() ?>">
                            <input type="hidden" id="grandTotal" name="grandTotal" value=""></input>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) {
                                echo form_hidden('qty' . $i++, $items['qty']);
                            } ?>
                        </div>
                        <!-- <div id="grandTotal" placeholder="" value=""></div> -->


                    </div>

                    <hr>
                </div>
            </div>
            <div class="col-sm-12 mt-5">
                <div class="row d-flex ">
                    <div class="col-sm-6 justify-content-start ">
                        <a class="ml-auto btn hvr-hover text-white" href="<?= base_url() ?>user/cart_controller">Return to Cart</a>
                    </div>
                    <div class="col-sm-6 d-flex align-items-end">
                        <a class="ml-auto btn hvr-hover"><button type="submit" class="text-white" style="background-color: transparent; border: none">Place Order</button></a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

</div>
</div>
<!-- End Cart -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url(); ?>/user/order_controller/getKecamatan/",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                cache: false,
                success: function(array) {
                    var html = '';
                    var i;
                    for (i = 0; i < array.length; i++) {
                        html += '<option value=' + array[i].id_kec + '>' + array[i].kecamatan + '</option>'
                    }
                    $('#kecamatan').html(html);
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#shipping_method').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url(); ?>/user/order_controller/getShipping/",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                cache: false,
                success: function(array) {
                    var html = '';
                    var cost = '';
                    var grandtotal = '';

                    var i;
                    for (i = 0; i < array.length; i++) {
                        html += '<div class="custom-control custom-radio mt-3"> <input id="shippingOption5" name="shipping_method" class="custom-control-input" checked="checked" type="radio" value=' + array[i].ship_id + '><label class="custom-control-label" for="shippingOption5">' + array[i].shipping_method + '</label><span class="float-right font-weight-bold"><span id="rupiah">Rp.' + (array[i].tax / 1000).toFixed(3) + ',00</span></span></div><div class="ml-4 mb-2 small"> Lokasi <strong>' + array[i].lokasi + '</strong></div>';
                        cost += array[i].tax
                        grandtotal += parseInt(array[i].tax) + parseInt(<?= $this->cart->total() ?>);
                    }
                    $('#shipping').html(html);
                    $('#shipping_cost').html('Rp. ' + (cost / 1000).toFixed(3) + ',00');
                    $('#grand_total').html('Rp. ' + (grandtotal / 1000).toFixed(3) + ',00');


                    // $('#grandTotal').html((grandtotal / 1000).toFixed(3));
                    // $('#grandTotal').html('Rp. ' + (grandtotal / 1000).toFixed(3) + ',00');
                    // $('#grandTotal').html('<input type="text" class="form-control" name="total" placeholder="" value="' + grandtotal + '">');
                    $('#grandTotal').val(grandtotal);
                }
            })
        })
    })
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            minDate: moment().add('d', 1).toDate(),
        });
    });
</script>

<!-- <script src="<?= base_url('/assets/user/autoNumeric.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#rupiah').autoNumeric('init');
    });
</script> -->

<!-- <php foreach ($ship as $s) { ?>
                                <div class="custom-control custom-radio">
                                    <input id="shippingOption1" name="shipping_method" class="custom-control-input" value="Ambil ke Homestore" checked="checked" type="radio">
                                    <label class="custom-control-label" for="shippingOption1"></label>
                                    <span class="float-right font-weight-bold">FREE</span> 
                            <php } ?>-->
<!-- <div class="custom-control custom-radio">
                                <input id="shippingOption2" name="shipping_method" class="custom-control-input" value="COD Badung" checked="checked" type="radio">
                                <label class="custom-control-label" for="shippingOption2">COD Badung</label>
                                <span class="float-right font-weight-bold">FREE</span>
                            </div>
                            <div class="ml-4 mb-2 small">Lokasi Puspem Badung</div>

                            <div class="custom-control custom-radio">
                                <input id="shippingOption3" name="shipping_method" class="custom-control-input" value="COD_Denpasar" checked="checked" type="radio">
                                <label class="custom-control-label" for="shippingOption3">COD Denpasar</label> <span class="float-right font-weight-bold">FREE</span>
                            </div>
                            <div class="ml-4 mb-2 small">Lokasi Taman Kota Denpasar, Lumintang</div>

                            <div class="custom-control custom-radio">
                                <input id="shippingOption4" name="shipping_method" class="custom-control-input" value="COD_Denpasar" checked="checked" type="radio">
                                <label class="custom-control-label" for="shippingOption4">COD Gianyar</label> <span class="float-right font-weight-bold">FREE</span>
                            </div>
                            <div class="ml-4 mb-2 small">Lokasi Lapangan Astina, Gianyar</div>

                            <div class="custom-control custom-radio">
                                <input id="shippingOption5" name="shipping_method" class="custom-control-input" checked="checked" type="radio">
                                <label class="custom-control-label" for="shippingOption5">COD Tabanan</label> <span class="float-right font-weight-bold">FREE</span>
                            </div>
                            <div class="ml-4 mb-2 small">Lokasi Patung Soekarno, Kediri</div>

                            <div class="custom-control custom-radio">
                                <input id="shippingOption6" name="shipping_method" class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="shippingOption6">Jasa Antar</label> <span class="float-right font-weight-bold">Rp. 20.000</span>
                            </div>
                            <div class="ml-4 mb-2 small">Grab</div> -->