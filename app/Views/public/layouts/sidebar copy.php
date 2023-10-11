<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-teal ">
        <img src="https://i.ibb.co/wph2S6n/singa-ambara-raja.png" alt="singa-ambara-raja" class="justify-content-center"
            height="40" width="65">
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    <a href="<?php echo base_url() ?>admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/users') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>List User</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/users') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo base_url('admin/user') ?>" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            Dinas
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo base_url() ?>admin/kategory" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kategori
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/perihal') ?>" class="nav-link">
                                <i class="nav-icon fas fa-pen-nib"></i>
                                <p>Tambah Kategori</p>
                            </a>
                        </li>
                    </ul>


                </li>


                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Tentang
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                    
                        <p>
                            Pengaturan
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-left"></i>
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