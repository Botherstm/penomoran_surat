<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Main content -->
            <!-- <div class="row jarak ">
                    <div class="card-tools">
                        <div class="btnadd">
                        </div>
                    </div>
                    <div class="card-tools">
                    </div>
                </div> -->

            <div class="card card-warning" style="margin: 0px 250px 0px 250px;" >


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Edit Data Bidang <?= $bidang['name']; ?></h3>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('admin/bidang/update/') ?><?= $bidang['id']; ?>" method="POST" class="">
        <?= csrf_field(); ?>
      
        <div class="mb-5 m-1 ">
            <label for="bidang" class="form-label input-group ">Nama Bidang</label>
            <input type="text" name="name" value="<?= $bidang['name']; ?>" class="form-control" id="name"
                aria-describedby="emailHelp">
        </div>
        <div class="form-group text-center">
            <input type="name" hidden value="<?= $bidang['instansi_id']; ?>" class="form-control" id="instansi_id"
                name="instansi_id" readonly>
        </div>
        <div class="form-group text-center">
            <input type="name" hidden value="<?= $bidang['slug']; ?>" class="form-control" id="slug" name="slug"
                readonly>
        </div>
        <div class="mb-5 m-1">
            <label for="kodeBidang" class="form-label input-group ">Kode Bidang</label>
            <input type="name" name="kode" value="<?= $bidang['kode']; ?>" class="form-control"
                id="kodeBidang">
        </div>

        <div class="row text-center">

            <div class="col-md-6">
                <a href="<?php echo base_url('admin/dinas/bidang/') ?><?= $instansi ?>">
                    <button type="button" class="btn btn-danger" style="width: 150px;">Batal</button>
                </a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 150px;">Edit Data</button>
            </div>
        </div>

    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">


    <form action="<?php echo base_url('admin/bidang/update/') ?><?= $bidang['id']; ?>" method="POST" class="">
        <?= csrf_field(); ?>
        <div class="input-group justify-content-center mb-3">
            <h2 class="mt-5 mb-5">Edit Bidang</h2>
        </div>
        <div class="mb-5 m-1 ">
            <label for="bidang" class="form-label input-group justify-content-center">Nama Bidang</label>
            <input type="text" name="name" value="<?= $bidang['name']; ?>" class="form-control w-50 m-auto" id="name"
                aria-describedby="emailHelp">
        </div>
        <div class="form-group text-center">
            <input type="name" hidden value="<?= $bidang['instansi_id']; ?>" class="form-control" id="instansi_id"
                name="instansi_id" readonly>
        </div>
        <div class="form-group text-center">
            <input type="name" hidden value="<?= $bidang['slug']; ?>" class="form-control" id="slug" name="slug"
                readonly>
        </div>
        <div class="mb-5 m-1">
            <label for="kodeBidang" class="form-label input-group justify-content-center">Kode Bidang</label>
            <input type="name" name="kode" value="<?= $bidang['kode']; ?>" class="form-control w-50 m-auto"
                id="kodeBidang">
        </div>

        <div class="row text-center">

            <div class="col-md-6">
                <a href="<?php echo base_url('admin/dinas/bidang/') ?><?= $instansi ?>">
                    <button type="button" class="btn btn-danger" style="width: 25%;">Batal</button>
                </a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Edit Data</button>
            </div>
        </div>

    </form>


</div>


<?= $this->endSection('content'); ?>