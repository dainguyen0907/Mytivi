<div class="dash-nav dash-nav-dark">
    <header>
        <a href="javascript::void()" class="menu-toggle">
            <i class="fas fa-bars"></i>
        </a>
        <a href="<?= base_url() . "admin" ?>" class="easion-logo"><i class="fa-solid fa-tv"></i> <span>Mytivi</span></a>
    </header>
    <nav class="dash-nav-list">
        <a href="<?= base_url() . "admin" ?>" class="dash-nav-item">
            <i class="fas fa-home"></i> Thống kê </a>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-users"></i> Tài khoản </a>
            <div class="dash-nav-dropdown-menu">
                <a href=<?= base_url() . "admin/user" ?> class="dash-nav-dropdown-item">Danh sách</a>
                <a href="<?= base_url() . "admin/user/add" ?>" class="dash-nav-dropdown-item">Thêm mới</a>
            </div>
        </div>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-cube"></i> Chương trình </a>
            <div class="dash-nav-dropdown-menu">
                <a href="<?= base_url() . "admin/program" ?>" class="dash-nav-dropdown-item">Danh sách</a>
                <a href="<?= base_url() . "admin/program/add" ?>" class="dash-nav-dropdown-item">Thêm mới</a>
            </div>
        </div>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-comments"></i> Lịch chiếu </a>
            <div class="dash-nav-dropdown-menu">
                <a href="<?= base_url() . "admin/schedule" ?>" class="dash-nav-dropdown-item">Danh sách</a>
                <a href="<?= base_url() . "admin/schedule/add" ?>" class="dash-nav-dropdown-item">Thêm mới</a>
            </div>
        </div>
        <a href="<?= base_url() . "admin/contact" ?>" class="dash-nav-item">
            <i class="fas fa-info"></i>Liên hệ
        </a>
    </nav>
</div>