<aside class="main-sidebar sidebar-light-primary elevation-4" style="position: fixed;">

    <!-- ready -->



    <a href="index3.html" class="brand-link bg-teal ">
        <img src="https://i.ibb.co/wph2S6n/singa-ambara-raja.png" alt="singa-ambara-raja" class="justify-content-center" height="40" width="65">
        <span class="brand-text font-weight-bold " style="text-shadow: 2px 2px 1px grey; padding-top: 10px;">E-NOMOR
            Admin</span>
    </a>
    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="padding-top: 10px; align-items: center;">
    <?php if (session()->get('gambar') !== null) : ?>
        <div class="image" style="margin-right: 10px;">
            <img src="<?php echo base_url('userimage/') ?><?= session()->get('gambar'); ?>"
                class="img-circle elevation-2" alt="User Image" style="width: 50px;"> <!-- Sesuaikan nilai width -->
        </div>
    <?php else : ?>
    <?php endif ?>

    <div class="info">
        <a class="d-block"><?= session()->get('name'); ?></a>
    </div>
</div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false" style=" padding-bottom: 16em; ">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="<?php echo base_url('admin') ?>" class="nav-link <?= $active == 'admin' ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Beranda
                        </p>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="<?php echo base_url('admin/users') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'users') ? 'active  bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <?php if (session()->get('level') == 1) : ?>

                    <li class="nav-item ">
                        <a href="<?php echo base_url('admin/bidang/') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'bidang') ? 'active  bg-success' : ''; ?> ">
                            <i class="nav-icon fas fa-city"></i>
                            <p>
                                Bidang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?php echo base_url('admin/riwayatsurat') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'riwayatsurat') ? 'active  bg-success' : ''; ?>">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Riwayat Surat
                            </p>
                        </a>
                    </li>
                <?php elseif (session()->get('level') == 2) : ?>
                    <li class="nav-item ">
                        <a href="<?php echo base_url('admin/dinas/') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'dinas') ? 'active  bg-success' : ''; ?>">
                            <i class="nav-icon fas fa-city"></i>
                            <p>
                                Dinas
                            </p>
                        </a>
                    </li>
                    <!-- Develop KATEGORI, perihal, sub perihal, detail  -->
                    <li class="nav-item ">
                        <a href="<?php echo base_url('admin/kategori') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'kategori') ? 'active  bg-success' : ''; ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Kategori
                            </p>
                        </a>
                    </li>

                <?php endif; ?>
            </ul>

            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <li class="nav-item " >
                    <a href="<?php echo base_url('/admin/tentang') ?>" class="nav-link <?= $active == 'tentang' ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Tentang
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo base_url('admin/user/profile') ?>" class="nav-link <?= (current_url(true)->getSegment(1) == 'admin' && current_url(true)->getSegment(2) == 'user') ? 'active  bg-success' : ''; ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link" onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
       onmouseout="this.style.backgroundColor=''; this.style.color='';">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="auto" fill="currentColor" class="bi bi-box-arrow-left  " viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                        <p style="padding-left: 5px;">Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



</aside>