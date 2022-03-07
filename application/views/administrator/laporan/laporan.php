<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <form action="<?= base_url() ?>admin/laporan_controller/laporanHarian" method="POST">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="card-wrap">

                            <div class="card-body">
                                <h4 class="mt-3">Laporan Harian</h4>
                            </div>
                        </div>
                        <div class="card-stats">
                            <div class="row ml-1 mr-1">
                                <div class="col-sm-4">
                                    <div class="card-stats-item-label">Tanggal</div>
                                    <select name="tanggal" class="form-control" id="tanggal">
                                        <?php
                                        $mulai = 1;
                                        for ($i = $mulai; $i < $mulai + 31; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card-stats-item-label"><strong>Bulan</strong></div>
                                    <select name="bulan" class="form-control" id="bulan">
                                        <?php
                                        $mulai = 1;
                                        for ($a = $mulai; $a < $mulai + 12; $a++) {
                                            echo '<option value="' . $a . '">' . $a . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card-stats-item-label"><strong>Tahun</strong></div>
                                    <select name="tahun" class="form-control" id="tahun">
                                        <?php
                                        $mulai = date('Y');
                                        for ($i = $mulai; $i < $mulai + 7; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-wrap mt-3">
                            <div class="card-header p-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Cari Laporan harian</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="card-wrap">

                    <div class="card-body">
                        <h4 class="mt-3">Laporan Bulanan</h4>
                    </div>
                </div>
                <div class="card-stats">
                    <form action="<?= base_url() ?>admin/laporan_controller/laporanBulanan" method="POST">
                        <div class="row">
                            <div class="col ml-4 mr-4">
                                <div class="card-stats-item-label"><strong>Bulan</strong></div>
                                <select name="bulan2" class="form-control" id="bulan2">
                                    <?php
                                    $mulai = 1;
                                    for ($i = $mulai; $i < $mulai + 12; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col ml-4 mr-4">
                                <div class="card-stats-item-label"><strong>Tahun</strong></div>
                                <select name="tahun2" class="form-control" id="tahun2">
                                    <?php
                                    $mulai = date('Y');
                                    for ($i = $mulai; $i < $mulai + 7; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                </div>
                <div class="card-wrap mt-3">
                    <div class="card-header p-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Cari Laporan Bulanan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="card-wrap">

                    <div class="card-body">
                        <h4>Laporan Tahunan</h4>
                    </div>
                </div>
                <div class="card-stats">
                    <form action="<?= base_url() ?>admin/laporan_controller/laporanTahunan" method="POST">
                        <div class="ml-4 mr-4">
                            <div class="card-stats-item-label"><strong>Tahun</strong></div>
                            <select name="tahun3" class="form-control" id="tahun3">
                                <?php
                                $mulai = date('Y');
                                for ($i = $mulai; $i < $mulai + 7; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="card-wrap mt-3">
                    <div class="card-header p-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Cari Laporan Tahunan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>


</section>
</div>