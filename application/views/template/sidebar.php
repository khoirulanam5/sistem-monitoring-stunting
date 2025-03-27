<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #83A6CE;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center m-4" href="">
                <div class="sidebar-brand-text ml-1"><i class="fas fa-notes-medical"></i> Monitoring <br><small>Stunting</small></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if($this->session->userdata('level') == 'PIMPINAN'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'user') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pimpinan/user') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data User</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'daftar_bantuan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pimpinan/daftar_bantuan') ?>">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Bantuan Stunting</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'bantuan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pimpinan/bantuan') ?>">
                        <i class="fas fa-fw fa-clipboard"></i>
                        <span>Bantuan Non Stunting</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('pimpinan/laporan') ?>">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($this->session->userdata('level') == 'ADMIN'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'stunting') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/stunting') ?>">
                        <i class="fas fa-fw fa-hand-holding-medical"></i>
                        <span>Data Stunting</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'penerima') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/penerima') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Penerima</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'stok') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/stok') ?>">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Stok FIFO</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php endif;?>

            <?php if($this->session->userdata('level') == 'PETUGAS'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pengambilan') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('petugas/pengambilan') ?>">
                        <i class="fas fa-fw fa-box-open"></i>
                        <span>Pengambilan Bantuan</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pengiriman') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('petugas/pengiriman') ?>">
                        <i class="fas fa-fw fa-truck"></i>
                        <span>Pengiriman Bantuan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($this->session->userdata('level') == 'PENERIMA'): ?>
                <li class="nav-item <?= ($this->uri->segment(2) == 'distribusi') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('penerima/distribusi') ?>">
                        <i class="fas fa-fw fa-hand-holding-medical"></i>
                        <span>Distribusi Bantuan</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="navbar">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <ul class="nav navbar-nav navbar-right">

                                <a class="btn btn-primary btn-sm logout" href="<?= base_url('auth/logout') ?>">Logout</a>

                            </ul>

                        </div>
                    </ul>

                </nav>

                <script>
                document.querySelectorAll('.logout').forEach(item => {
                        item.addEventListener('click', function(e) {
                            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
                            var url = this.getAttribute('href'); // Ambil URL dari atribut href
                            Swal.fire({
                                title: "Yakin Ingin Keluar?",
                                text: "",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Keluar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Jika konfirmasi, redirect ke URL penghapusan
                                    window.location.href = url;
                                }
                            });
                        });
                    });
                </script>