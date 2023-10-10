<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
    .row {
        padding-left: 150px;
        padding-right: 150px;
    }

</style>

<div class="content-wrapper">
    

        <form class="">

            <div class="input-group justify-content-center mb-3">
                <h2 class="mt-5 mb-5">Tambah Sub Perihal</h2>                
            </div>
            <div class="mb-5 m-1 ">
                 <label for="SubPerihal" class="form-label input-group justify-content-center">Sub Perihal</label>
                 <input type="text" class="form-control w-50 m-auto " id="SubPerihal" aria-describedby="emailHelp">
            </div>
            <div class="mb-5 m-1">
                <label for="kodeSubPerihal" class="form-label input-group justify-content-center">Kode Sub Perihal</label>
                <input type="number" class="form-control w-50 m-auto" id="kodeSubPerihal">
            </div>

            <div class="row text-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger" style="width: 25%;">Batal</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Tambah data</button>
            </div>
        </div>

        </form>

      
</div>


<?= $this->endSection('content'); ?>