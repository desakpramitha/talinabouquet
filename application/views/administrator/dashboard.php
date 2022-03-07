<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <h5>Pesanan</h5>
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $countStatus['unpaid'] ?></div>
                                <div class="card-stats-item-label">Belum dibayar</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $countStatus['proses'] ?></div>
                                <div class="card-stats-item-label">Diproses</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $countStatus['siap_antar'] ?></div>
                                <div class="card-stats-item-label">Shipping</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= $countStatus['complete'] ?></div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            <?= $count ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <h5>Product</h5>
                        </div>
                        <div class="card-stats-items">

                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas"><img src="<?= base_url() ?>assets/img/bouquet1.svg" width="25px" alt=""></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Product</h4>
                        </div>
                        <div class="card-body">
                            <?= $product ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <h5>Testimoni</h5>
                        </div>
                        <div class="card-stats-items">

                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total testimoni</h4>
                        </div>
                        <div class="card-body">
                            <?= $testimoni ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-lg-4">
        <div class="card gradient-bottom">
            <div class="card-header">
                <h4>Top 5 Products</h4>
                <!-- <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <li class="dropdown-title">Select Period</li>
                        <li><a href="#" class="dropdown-item">Today</a></li>
                        <li><a href="#" class="dropdown-item">Week</a></li>
                        <li><a href="#" class="dropdown-item active">Month</a></li>
                        <li><a href="#" class="dropdown-item">This Year</a></li>
                    </ul>
                </div> -->
            </div>
            <div class="card-body" id="top-5-scroll">
                <?php foreach ($productBest as $p) : ?>
                    <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                            <img class="mr-3 rounded" width="55" src="<?= base_url() ?>assets/img/uploads/<?= $p['image_product'] ?>" alt="product">
                            <div class="media-body">
                                <div class="float-right">
                                    <div class="font-weight-600 text-muted text-small"><?= $p['jumlah'] ?></div>
                                </div>
                                <div class="media-title"><?= $p['product_name'] ?></div>
                            </div>
                        </li>
                    <?php endforeach ?>
                    </ul>
            </div>
        </div>
    </div>
</div>