<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
    .row {
        padding-left: 150px;
        padding-right: 150px;
    }

    .theme1 {
        background-color: dark;
    }
</style>

<div class="content-wrapper">

    <div class="row text-center">
        <div class="input-group justify-content-center mb-3">
            <h2 class="mt-5 mb-5">Pengaturan</h2>
        </div>
        <div class="mb-5 m-1 theme1">
            <button type="submit" class="" style="width: 50%;">Dark</button>
        </div>
        <div class="mb-5 m-1 theme2">
            <button type="submit" class="" style="width: 50%;">Light</button>
        </div>
        <div class="mb-5 m-1 theme3">
            <button type="submit" class="" style="width: 50%;">Light Green</button>
        </div>
    </div>



    <div class="row text-center">
        <div class="col-md-6">
            <button type="button" class="btn btn-danger" style="width: 25%;">Batal</button>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-success " style="width: 25%;">Ubah data</button>
        </div>
    </div>


</div>

<?= $this->endSection('content'); ?>