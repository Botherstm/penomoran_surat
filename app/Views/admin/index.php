<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Beranda</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Beranda</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content mt-5">
            <div class="container-fluid ">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>User</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>
                            </div>
                            <a href="/admin/users" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-7">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Dinas</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-window-split" viewBox="0 0 16 16">
                                    <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z" />
                                    <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2Zm12 1a1 1 0 0 1 1 1v2H1V3a1 1 0 0 1 1-1h12ZM1 13V6h6.5v8H2a1 1 0 0 1-1-1Zm7.5 1V6H15v7a1 1 0 0 1-1 1H8.5Z" />
                                </svg>
                            </div>
                            <a href="/admin/dinas" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <!-- ./col -->
                    <div class="col-lg-6 col-7">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>Kategori</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z" />
                                    <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z" />
                                </svg>
                            </div>
                            <a href="/admin/kategori" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->

        </section>
    </div><!-- /.container-fluid -->

    <!-- /.content -->
</div>


<?= $this->endSection('content'); ?>