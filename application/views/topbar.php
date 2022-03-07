<body>
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html"><img class="img-fluid" src="<?= base_url(); ?>assets/user/images/icon.png" width="60px" alt=""><img class="img-fluid" src="<?= base_url(); ?>assets/user/images/logo2.png" width="150px" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <!-- HOME -->
                        <li class="nav-item active"><a class="nav-link" href="<?= base_url('dashboard_controller'); ?>">Home</a></li>

                        <!-- TESTIMONI -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard_controller/testimonials'); ?>">Testimonials</a></li>

                        <!-- PRODUCT -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>dashboard_controller/shop">Shop</a></li>

                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>dashboard_controller/ourService">Our Service</a></li>

                        <!-- USER -->
                        <!-- <php if (!$this->session->userdata('is_login')) : ?> -->
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>auth_controller">Login <i class="fa fa-user"></i></a></li>

                        <!-- <php else : ?>
                            <li class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown"><?= $user['name'] ?></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<= base_url(); ?>user/pelanggan_controller/profileUser"><i class="fas fa-user"></i> My Profile</a></li>
                                    <li><a href="<= base_url(); ?>user/pelanggan_controller/changePassword"><i class="fas fa-key"></i> Edit Password</a></li>
                                    <li><a href="<= base_url(); ?>user/order_controller/myOrders"><i class="fas fa-shopping-cart"></i> My Orders</a></li>
                                    <li><a href="<= base_url(); ?>auth_controller/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </li>
                        <php endif; ?> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="<= base_url(); ?>auth_controller">Login <i class="fa fa-user"></i></a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="contact-us.html">Register <i class="fa fa-user"></i></a></li> -->
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <?php if (!$this->session->userdata('is_login')) : ?>
                    <div class="attr-nav">
                        <ul>
                            <!-- <li class="search"><a href="#"><i class="fa fa-search"></i></a></li> -->
                            <li class="side-menu">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="badge">0</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php else : ?>
                    <?php
                    $cart = $this->cart->contents();
                    $total_item = 0;

                    foreach ($cart as $c) {
                        $total_item = $total_item + $c['qty'];
                    }
                    ?>

                    <div class="attr-nav">
                        <ul>
                            <!-- <li class="search"><a href="#"><i class="fa fa-search"></i></a></li> -->
                            <li class="side-menu">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="badge"><?= $total_item ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <?php if (!$this->session->userdata('is_login')) : ?>

                        <ul class="cart-list text-center">
                            <li> <strong>Please Login</strong></li>

                            <li class="total">
                                <a href="<?= base_url() ?>auth_controller" class="btn btn-sm hvr-hover btn-cart">Login</a>
                            </li>
                        </ul>
                </li>
            <?php else : ?>
                <?php if (!$cart) { ?>
                    <ul class="cart-list text-center p-3">
                        <strong>Empty Cart</strong>
                    </ul>
                <?php   } ?>
                <ul class="cart-list">
                    <?php foreach ($cart as $c) {
                    ?>

                        <li>
                            <a href="#" class="photo"><img src="<?= base_url(); ?>assets/img/uploads/<?= $c['image'] ?>" class="cart-thumb" alt="" /></a>
                            <h6><a href="#"><?= $c['name']; ?></a></h6>
                            <p><?= $c['qty'] ?> x <span class="price">Rp. <?= number_format($c['price'], 2, ',', ',') ?></span></p>
                        </li>
                    <?php } ?>

                    <li class="total">
                        <a href="<?= base_url(); ?>user/cart_controller/" class="btn btn-sm hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right">Rp. <?= $this->cart->format_number($this->cart->total()); ?></span>
                    </li>
                </ul>
                </li>
            </div>
        <?php endif; ?>
        <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->