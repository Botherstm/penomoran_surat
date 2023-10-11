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
            <h2 class="mt-5 mb-5">Edit Detail <?= $detailsubperihal['name']; ?></h2>
        </div>
        <div class="mb-5 m-1 ">
            <label for="kategori" class="form-label input-group justify-content-center">Detail</label>
            <input type="text" name="name" class="form-control w-50 m-auto " id="name" aria-describedby="emailHelp">
        </div>

        <div class="form-group text-center">
            <input type="name" class="form-control" id="perihal_id" name="perihal_id" value="<?= $subperihal['id']; ?>"
                readonly>
        </div>
        <div class="form-group text-center">
            <input type="name" value="<?= $detailsubperihal['slug']; ?>" class="form-control" id="slug" name="slug"
                readonly>
        </div>
        <div class="mb-5 m-1">
            <label for="kodeKategori" class="form-label input-group justify-content-center">Kode Detail</label>
            <input type="name" name="kode" class="form-control w-50 m-auto" id="kodeKategori">
        </div>

        <div class="row text-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger" style="width: 25%;">Batal</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Ubah data</button>
            </div>
        </div>

    </form>


</div>


<?= $this->endSection('content'); ?>