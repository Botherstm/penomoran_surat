<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
.table td {
    text-align: center;
    background-color: #C5E9DE;

}


.table>thead>tr>* {
    background-color: #20c997;
    text-align: center;
}


.btnadd {

    padding-left: 17px;
}

.btnr {

    padding-inline-end: 15%;

}

.icon-jarak {
    padding-right: 10px;
}

.jarak {
    justify-content: space-between;

}

.halpad {
    padding: 30px 50px 10px 50px;
}

</style>

<div class="halpad content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6 ">
                    <h1 class=" font-weight-bold ">List Kategori</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">
            <div class="card-tools">

                <div class="btnadd">
                    <a href="<?php echo base_url('admin/kategori/addkategori') ?>">
                        <button type="button" class="btn btn-success">
                            <i class="icon-jarak fas fa-plus"></i>
                            Tambah
                        </button>
                    </a>

                </div>
            </div>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class=" card-body table-responsive p-10">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Kode Kategori</th>
                            <th>Rincian Perihal</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>??</td>
                            <td>??</td>
                            <td>??</td>
                            <td><div>
                                    <!-- update -->
                                    <a href="<?php echo base_url('admin/users/create') ?>">
                        <button type="button" class="btn btn-dark">
                            Lihat rincian perihal
                        </button>
                    </a>
                                </div></td>
                            <td>

                                <div class="btn-group ">
                                    <!-- update -->
                                    <a class="btnr"
                                        href="#">
                                        <button type="button" class="btn btn-block btn-warning ">
                                            <i class=" fas fa-pen"></i>
                                        </button>
                                    </a>
                                    <a class="btnr" href="#">
                                        <button type="button" class="btn btn-block btn-danger"><i
                                                class=" fas fa-trash"></i></button>
                                    </a>
                                </div>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

</div>


<?= $this->endSection('content'); ?>