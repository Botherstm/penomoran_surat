<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
.row {
    padding-left: 150px;
    padding-right: 150px;
}
</style>

<div class="content-wrapper">
    <form action="<?php echo base_url('admin/bidang/save') ?>" method="POST" class="">
        <?= csrf_field(); ?>
        <div class="input-group justify-content-center mb-3">
            <h2 class="mt-5 mb-5">Tambah Bidang <?= $instansi['name']; ?></h2>
        </div>
        <div class="mb-5 m-1 ">
            <label for="bidang" class="form-label input-group justify-content-center">Nama Bidang</label>
            <input type="text" class="form-control w-50 m-auto " name="name" id="name" aria-describedby="emailHelp">
        </div>
        <div class="form-group text-center">
            <input type="name" hidden class="form-control" id="instansi_id" name="instansi_id"
                value="<?= $instansi['id']; ?>" readonly>
        </div>
        <div class="form-group text-center">
            <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
        </div>
        <div class="mb-5 m-1 ">
            <label for="bidang" class="form-label input-group justify-content-center">Kode Bidang</label>
            <input type="name" class="form-control w-50 m-auto " name="kode" id="kode" aria-describedby="emailHelp">
        </div>
        <div class="row text-center">
            <div class="col-md-6">
                <a href="<?php echo base_url('admin/dinas/bidang/') ?><?= $instansi['slug']; ?>">
                    <button type="button" class="btn btn-danger" style="width: 25%;">Batal</button>
                </a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success " style="width: 25%;">Tambah data</button>
            </div>
        </div>

    </form>


</div>


<script>
var nameInput = document.getElementById('name');
var slugInput = document.getElementById('slug');

// Function to generate a slug from the given string
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/[^\w\-]+/g, '') // Remove non-word characters (except dashes)
        .replace(/\-\-+/g, '-') // Replace multiple dashes with a single dash
        .substring(0, 50); // Limit the slug length
}

// Add an input event listener to the name input field
nameInput.addEventListener('input', function() {
    var nameValue = nameInput.value;
    var slugValue = slugify(nameValue);
    slugInput.value = slugValue;
});
</script>
<?= $this->endSection('content'); ?>