<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">

                    <?php $codeview = 0; ?>
                    <?php foreach ($image as $i) {   ?>
                        <?php $codeview++; ?>
                        <?php if ($codeview == 1) { ?>

                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"> <img class="d-block w-100" src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" alt="First slide"> </div>
                            <?php } else { ?>
                                <div class="carousel-item"> <img class="d-block w-100" src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" alt="Second slide"> </div>
                        <?php }
                    } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <?php $codeview = 0; ?>
                            <?php foreach ($image as $i) {   ?>
                                <?php $codeview++; ?>
                                <?php if ($codeview == 1) { ?>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                            <img class="d-block w-100 img-fluid" src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" alt="" />
                                        </li>
                                    <?php } else { ?>
                                        <li data-target="#carousel-example-1" data-slide-to="1">
                                            <img class="d-block w-100 img-fluid" src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" alt="" />
                                        </li>
                                <?php }
                            } ?>
                                    </ol>

                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <?php foreach ($product as $p) : ?>
                    <div class="single-product-details">
                        <?= form_open('user/cart_controller/addCart');
                        echo form_hidden('id', $p['product_id']);
                        echo form_hidden('price', $p['price']);
                        echo form_hidden('name', $p['product_name']);
                        echo form_hidden('image', $p['image_product']); ?>

                        <h2><?= $p['product_name'] ?></h2>
                        <p class="available-stock"><span> Category / <a href="#"><?= $p['category_name'] ?> </a></span>
                        <h5><?= number_format($p['price'], 2, ".", ",") ?></h5>
                        <p>
                        <h4>Short Description:</h4>
                        <p><?= $p['description'] ?>. </p>
                        <ul>

                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" name="qty" value="1" min="1" max="20" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" href="<?= base_url(); ?>dashboard_controller/shop" data-fancybox-close="">Return to shop</a>
                                <a class="btn hvr-hover"><button type="submit" class="text-white" style="background-color: transparent; border: none">Add to Cart</button></a>
                                <!-- <a class="btn hvr-hover"><button class="text-white" style="background-color: transparent; border: none">Return to shop</button></a> -->
                                <!-- <a class="btn hvr-hover"><button type="submit" href="#">Add to cart</button></a> -->
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
            </div>
        </div>

    <?php endforeach; ?>
    </div>
</div>
<!-- End Cart -->