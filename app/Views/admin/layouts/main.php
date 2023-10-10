<?= $this->include('admin/layouts/header'); ?>
<?= $this->include('admin/layouts/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Beranda</h1>
                </div><!-- /.col -->
                <div class="col">
                    <ol class="breadcrumb float-sm-right">

                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                            <button type="button" class="btn">
                                <i class="fas fa-search"></i>
                            </button>

                        </div>


                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <?= $this->renderSection('content'); ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->include('admin/layouts/footer'); ?>