<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
.row {
    padding-left: 150px;
    padding-right: 150px;
}
</style>

<div class="content-wrapper">


    <form action="<?php echo base_url() ?>admin/kategori/save" method="POST" class="">
        <div class="input-group justify-content-center mb-3">
            <h2 class="mt-5 mb-5">Edit Urutan Surat</h2>
        </div>

        <div class="mb-5 m-1 ">
            <label for="urutan" class="form-label input-group justify-content-center">No. Urutan</label>
            <input type="text" class="form-control w-50 m-auto " name="name" id="name" aria-describedby="emailHelp">
        </div>

        <div class="row text-center">

            <div class="col-md-6">
                <a href="<?php echo base_url() ?>admin/urutansurat/index">
                    <button type="button" class="btn btn-danger" style="width: 25%;">Batal</button>
                </a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Tambah data</button>
            </div>
        </div>

    </form>


</div>


<?= $this->endSection('content'); ?>