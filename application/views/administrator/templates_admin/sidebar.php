<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url() ?>admin/admin_controller/index"><b>Talina Bouquet</b></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>admin/admin_controller/index">TB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item active">
                <a href="<?= base_url() ?>admin/admin_controller/index" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pengelolaan Data</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas"><img src="<?= base_url() ?>assets/admin/img/bouquet.svg" width="20px" alt=""></i> <span>Data Products</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url(); ?>admin/product_controller/index">Products</a></li>
                    <li><a class="nav-link" href="<?= base_url(); ?>admin/category_controller/index">Category</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="<?= base_url(); ?>admin/user_controller/index"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <li><a class="nav-link" href="<?= base_url(); ?>admin/testimoni_controller/index"><i class="fas fa-comments"></i> <span>Testimoni</span></a></li>
            <li class="menu-header">Pemesanan</li>
            <li><a class="nav-link" href="<?= base_url(); ?>admin/pesanan_controller/index"><i class="fas fa-shopping-bag"></i> <span>Pesanan</span></a></li>
            <li class="menu-header">Laporan</li>
            <li><a class="nav-link" href="<?= base_url(); ?>admin/laporan_controller/index"><i class="fas fa-file-alt"></i> <span>Laporan</span></a></li>
            <li><a class="mt-3 nav-link" data-toggle="modal" data-target="#logoutModal" href=""><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </aside>
</div>