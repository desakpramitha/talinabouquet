<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Products Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>admin/admin_controller/index">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data Products</a></div>
                <div class="breadcrumb-item">Gallery</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Article Style C</h2>
            <div class="row">
                <?php foreach ($product as $p) : ?>
                    <div class="col-12 col-md-4 col-lg-4">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image" data-background="<?= base_url() ?>assets/img/uploads/<?= $p['image_name'] ?>">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a href="#">Category</a>
                                    <div class="bullet"></div> <a href="#">Snack Bouquet</a>
                                </div>
                                <div class="article-title text-primary mt-2">
                                    <h5><?= $p['product_name'] ?></h5>
                                </div>
                                <hr>
                                <div class="article-category"><a href="#">Description :</a> </div>
                                <p><?= $p['description'] ?></p>
                                <div class="article-cta">
                                    <a class="btn btn-primary" href="<?= base_url() ?>admin/product_controller/viewProduct/<?= $p['product_id'] ?>">Detail <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
                <!-- 
                <div class="col-12 col-md-4 col-lg-4">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image" data-background="<?= base_url() ?>assets/img/uploads/banner-2.jpg">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-category"><a href="#">News</a>
                                <div class="bullet"></div> <a href="#">5 Days</a>
                            </div>
                            <div class="article-title">
                                <h2><a>Excepteur sint occaecat cupidatat non proident</a></h2>
                            </div>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="article-cta">
                                <a class="btn btn-primary" href="#">Read More <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image" data-background="../assets/img/news/img01.jpg">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-category"><a href="#">News</a>
                                <div class="bullet"></div> <a href="#">5 Days</a>
                            </div>
                            <div class="article-title">
                                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                            </div>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="article-cta">
                                <a class="btn btn-primary" href="#">Read More <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div> -->
            </div>
        </div>
    </section>
</div>