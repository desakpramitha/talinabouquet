<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $title ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller/shop">Home</a></li>
                    <li class="breadcrumb-item text-white"><a href="#"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<form action="<?= base_url() ?>user/cart_controller/updateCart" method="post">
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contents = $this->cart->contents(); ?>
                                <?php if (!$contents) { ?>
                                    <td class="text-center" colspan="7">
                                        <h4><strong>Empty Cart</h5>
                                    </td>
                                <?php } else { ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($contents as $items) : ?>
                                        <tr>
                                            <!-- <td><= $i++ ?></td> -->
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid" src="<?= base_url() ?>assets/img/uploads/<?= $items['image'] ?>" alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">
                                                    <?= $items['name'] ?>
                                                </a>
                                            </td>
                                            <td class="price-pr">
                                                <p>Rp. <?= number_format($items['price'], 2, ".", ",") ?></p>
                                            </td>
                                            <td class="quantity-box">
                                                <?= form_input(array(
                                                    'name' => $i . '[qty]',
                                                    'value' => $items['qty'],
                                                    'min' => "1",
                                                    'type' => "number",
                                                    'size' => "4",
                                                    'step' => "1",
                                                    'class' => "c-input-text qty text"
                                                )); ?>

                                                <!-- <input type="number" size="4" name="$i .'[qty]'" value="<= $items['qty'] ?>" min="0" step="1" class=""> -->
                                            </td>
                                            <td class="total-pr">
                                                <p>Rp. <?= $this->cart->format_number($items['subtotal']); ?></p>
                                            </td>
                                            <td class="remove-pr">
                                                <a href="<?= base_url() ?>user/cart_controller/deleteCart/<?= $items['rowid'] ?>">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php if (!$this->cart->contents()) : ?>
            <?php else : ?>
                <div class="row  mt-4">
                    <div class="col-sm-12 d-flex justify-content-start">
                        <div class="update-box">
                            <input value="Update Cart" type="submit">
                        </div>

                        <div class="update-box">
                            <a class="btn btn-lg hvr-hover text-light" href="<?= base_url() ?>user/cart_controller/clearCart">Empty Cart</button></a>
                        </div>
                        <div class="ml-3 update-box">
                            <a class="btn hvr-hover btn-lg text-light" href="<?= base_url() ?>dashboard_controller/shop">Return to shop</a></a>
                        </div>
                    </div>
                </div>
            <?php endif ?>

</form>
<div class="row my-5">
    <div class="col-lg-8 col-sm-12"></div>
    <div class="col-lg-4 col-sm-12">
        <div class="order-box">
            <h3>Order summary</h3>
            <!-- <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> Rp. <?= $this->cart->format_number($items['subtotal']); ?> </div>
                    </div> -->
        </div>
        <!-- <div class="d-flex">
                    <h4>Shipping Cost</h4>
                    <div class="ml-auto font-weight-bold"> Free </div>
                </div> -->
        <hr>
        <div class="d-flex gr-total">
            <h5>Grand Total</h5>
            <div class="ml-auto h5"> Rp. <?= $this->cart->format_number($this->cart->total()); ?></div>
        </div>
        <hr>
    </div>
</div>
<?php if (!$this->cart->contents()) : ?>
    <div class="col-12 d-flex shopping-box"><a href="<?= base_url() ?>dashboard_controller/shop" class="ml-auto btn hvr-hover">Return to shop</a> </div>
    </div>
<?php else : ?>
    <div class="col-12 d-flex shopping-box"><a href="<?= base_url() ?>user/order_controller/" class="ml-auto btn hvr-hover">Checkout</a> </div>
    </div>
<?php endif ?>

</div>
</div>
<!-- End Cart -->