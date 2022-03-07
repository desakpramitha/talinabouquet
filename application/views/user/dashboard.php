<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <li class="text-left">
            <img src="<?= base_url(); ?>assets/img/banner02-unsplash.jpg" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Talina Bouquet</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="<?= base_url() ?>dashboard_controller/shop">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="<?= base_url(); ?>assets/img/banner05-unsplash.jpg" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Talina Bouquet</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="<?= base_url() ?>dashboard_controller/shop">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/banner03-unsplash.jpg" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Talina Bouquet</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="<?= base_url() ?>dashboard_controller/shop">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-right">
            <img src="<?= base_url(); ?>assets/img/banner-04.jpg" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Talina Bouquet</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Category Products</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($category as $c) : ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="shop-cat-box shadow" style="border-color: white;">
                        <img class="img-fluid" src="<?= base_url(); ?>assets/img/category/<?= $c['category_image'] ?>" alt="" />
                        <a class="btn hvr-hover" href="<?= base_url() ?>dashboard_controller/shopByCategory/<?= $c['category_id'] ?>"><?= $c['category_name'] ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Start Products  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Products</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">All</button>
                        <button data-filter=".top-featured">New</button>
                        <button data-filter=".best-seller">Best seller</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row special-list">
            <?php if (!$product) : ?>

            <?php else : ?>
                <?php foreach ($product as $p) : ?>
                    <div class="col-lg-4 col-md-6 special-grid top-featured">
                        <?php echo form_open('user/cart_controller/addCart/' . $p['product_id']); ?>
                        <?php echo form_hidden('id', $p['product_id']);
                        echo form_hidden('qty', 1);
                        echo form_hidden('price', $p['price']);
                        echo form_hidden('name', $p['product_name']);
                        echo form_hidden('image', $p['image_product']); ?>
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="new">New</p>
                                </div>
                                <img src="<?= base_url(); ?>assets/img/uploads/<?= $p['image_product'] ?>" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="<?= base_url() ?>dashboard_controller/productDetail/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    </ul>
                                    <a class="cart"><button type="submit" class="text-white" style="background-color: transparent; border: none">Add to Cart</button></a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4><?= $p['product_name'] ?></h4>
                                <h5>Rp. <?= number_format($p['price'], 2, '.', '.') ?> </h5>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                <?php endforeach; ?>
            <?php endif; ?>


            <?php if (!$productBest) : ?>

            <?php else : ?>
                <?php foreach ($productBest as $p) : ?>
                    <div class="col-lg-4 col-md-6 special-grid best-seller">
                        <?php echo form_open('user/cart_controller/addCart/' . $p['product_id']); ?>
                        <?php echo form_hidden('id', $p['product_id']);
                        echo form_hidden('qty', 1);
                        echo form_hidden('price', $p['price']);
                        echo form_hidden('name', $p['product_name']);
                        echo form_hidden('image', $p['image_product']); ?>
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="sale">Best Seller</p>
                                </div>
                                <img src="<?= base_url(); ?>assets/img/uploads/<?= $p['image_product'] ?>" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="<?= base_url() ?>dashboard_controller/productDetail/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    </ul>
                                    <a class="cart"><button type="submit" class="text-white" style="background-color: transparent; border: none">Add to Cart</button></a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4><?= $p['product_name'] ?></h4>
                                <h5>Rp. <?= number_format($p['price'], 2, '.', '.') ?> </h5>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Products  -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <?php foreach ($image as $i) { ?>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="<?= base_url(); ?>assets/img/uploads/<?= $i['image_name'] ?>" alt="<?= $i['image_name'] ?>" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="item">
            <div class="ins-inner-box">
                <img src="<?= base_url(); ?>assets/img/banner05-unsplash.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="item">
            <div class="ins-inner-box">
                <img src="<?= base_url(); ?>assets/user/images/instagram-img-04.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="<?= base_url(); ?>assets/user/images/instagram-img-06.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->