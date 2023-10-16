<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
.row {
    padding-left: 150px;
    padding-right: 150px;
}
</style>

<div class="content-wrapper">


    <form action="<?php echo base_url('admin/urutansurat/save') ?>" method="POST" class="">
        <div class="input-group justify-content-center mb-3">
            <h2 class="mt-5 mb-5">Tambah Urutan Surat</h2>
        </div>
        <div class="form-group text-center">
            <input type="name" hidden class="form-control" id="instansi_id" name="instansi_id"
                value="<?= $instansi['id']; ?>" readonly>
        </div>
        <div class="mb-5 m-1 ">
            <label for="urutan" class="form-label input-group justify-content-center">No. Urutan</label>
            <input type="text" class="form-control w-50 m-auto " name="urutan" id="urutan" aria-describedby="emailHelp">
        </div>
        <div class="row text-center">
            <div class="col-md-6">
                <a href="<?php echo base_url() ?>admin/dinas">
                    <button type="button" class="btn btn-danger" style="width: 25%;">Batal</button>
                </a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Tambah data</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js">

</script>
<script>
<?php if (session()->getFlashdata('error')) : ?>
Swal.fire({
    title: 'error',
    text: '<?= session()->getFlashdata('error') ?>',
    icon: 'error',
    timer: 3000,
    showConfirmButton: false
});
<?php endif; ?>
</script>


<?= $this->endSection('content'); ?>