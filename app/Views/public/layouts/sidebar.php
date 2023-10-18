<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-teal">
        <a href="index3.html" class="brand-link bg-teal ">
            <img src="https://i.ibb.co/wph2S6n/singa-ambara-raja.png" alt="singa-ambara-raja"
                class="justify-content-center" height="40" width="65">
            <span class="brand-text font-weight-bold ">E-NOMOR</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!-- <div class="image">
                <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> -->
                <div class="info">
                    <a href="#" class="d-block"><?= session()->get('name'); ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo base_url('/') ?>" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                                Generate Nomor Surat
                            </p>
                        </a>
                    </li>

                    <?php if (session()->get('level') != 0) : ?>
                    <li class="nav-item ">
                        <a href="<?php echo base_url('admin') ?>" target="_blank" class="nav-link">
                            <i class="nav-icon fa fa-lock"></i>
                            <p>
                                Admin
                            </p>
                        </a>
                    </li>
                    <?php endif ?>

                    <li class="nav-item">
                        <a href="<?php echo base_url('public/riwayat/') ?>" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Riwayat Surat
                            </p>
                        </a>
                    </li>

                    <!-- coba untuk buat view -->
                    <!-- <li class="nav-item">
                        <a href="<?php echo base_url('rinciansurat') ?>" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Rincian Surat Download (coba)
                            </p>
                        </a>
                    </li> -->

                    <li class="nav-item ">
                        <a href="<?php echo base_url('/generate/terlewat/') ?>" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Generate Surat Terlewat
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('/tentang') ?>" class="nav-link">
                            <i class="nav-icon fas fa-info"></i>
                            <p>
                                Tentang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Pengaturan Akun
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                Keluar
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>