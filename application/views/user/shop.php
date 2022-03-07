    <!-- Start All Title Box -->
    <div class="all-title-box" style="background-image: url(<?= base_url() ?>assets/img/banner03-unsplash.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $title ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard_controller/shop">Home</a></li>
                        <li class="breadcrumb-item text-white"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="<?= base_url() ?>dashboard_controller/search" method="post">
                                <input class="form-control" name="keyword" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <a href="<?= base_url() ?>dashboard_controller/shop" class="list-group-item list-group-item-action">All</a><!-- <small class="text-muted">(150) </small> -->

                                <?php foreach ($category as $c) : ?>
                                    <a href="<?= base_url() ?>dashboard_controller/shopByCategory/<?= $c['category_id'] ?>" class="list-group-item list-group-item-action"> <?= $c['category_name'] ?></a>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">

                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        <?php foreach ($product as $p) : ?>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <?php echo form_open('user/cart_controller/addCart');
                                                echo form_hidden('id', $p['product_id']);
                                                echo form_hidden('qty', 1);
                                                echo form_hidden('price', $p['price']);
                                                echo form_hidden('name', $p['product_name']);
                                                echo form_hidden('image', $p['image_product']);
                                                ?>

                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <img src="<?= base_url(); ?>assets/img/uploads/<?= $p['image_product'] ?>" class="img-fluid" alt="">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="<?= base_url() ?>dashboard_controller/productDetail/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            </ul>
                                                            <a class="cart"><button type="submit" class="text-white" style="background-color: transparent; border: none">Add to Cart</button></a>

                                                        </div>
                                                    </div>
                                                    <div class="why-text">
                                                        <h4><?= $p['product_name'] ?></h4>
                                                        <h5>Rp <?= number_format($p['price'], 2, ".", ",") ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    <?php foreach ($product as $p) : ?>
                                        <div class="list-view-box">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">

                                                    <?php echo form_open('user/cart_controller/addCart');
                                                    echo form_hidden('id', $p['product_id']);
                                                    echo form_hidden('qty', 1);
                                                    echo form_hidden('price', $p['price']);
                                                    echo form_hidden('name', $p['product_name']);
                                                    echo form_hidden('image', $p['image_product']);
                                                    ?>
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">

                                                            <img src="<?= base_url(); ?>assets/img/uploads/<?= $p['image_product'] ?>" class="img-fluid" width="200px" height="120px" alt="Image">
                                                            <div class="mask-icon">
                                                                <ul>
                                                                    <li><a href="<?= base_url() ?>dashboard_controller/productDetail/<?= $p['product_id'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                    <div class="why-text full-width">
                                                        <h4><?= $p['product_name'] ?></h4>
                                                        <h5>Rp <?= number_format($p['price'], 2, ".", ",") ?></h5>
                                                        <p><?= $p['description'] ?>.</p>
                                                        <a class="btn hvr-hover"><button type="submit" class="text-white" style="background-color: transparent; border: none">Add to Cart</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= form_close() ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->