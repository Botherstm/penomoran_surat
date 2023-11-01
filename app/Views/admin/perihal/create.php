<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                    <li><?=esc($error)?></li>
                    <?php endforeach;?>
                </ul>
                <button id="dismissError" class="btn btn-primary">Ok</button>
            </div>
            <?php endif;?>
            <!-- Main content -->
            <!-- <div class="row jarak ">
                    <div class="card-tools">
                        <div class="btnadd">
                        </div>
                    </div>
                    <div class="card-tools">
                    </div>
                </div> -->

            <div class="card card-success" >


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Buat Data Perihal
                        <?=$kategori['name'];?></h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('admin/perihal/save') ?>" method="POST">
                        <?= csrf_field(); ?>

                        <div class="mb-5 m-1 ">
                            <label for="perihal" class="form-label input-group ">Perihal</label>
                            <input type="text" class="form-control  " name="name" id="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group text-center">
                            <input type="name" hidden class="form-control" id="detail_id" name="detail_id"
                                value="<?= $kategori['id']; ?>" readonly>
                        </div>
                        <div class="form-group text-center">
                            <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                        </div>
                        <div class="mb-5 m-1">
                            <label for="kodePerihal" class="form-label input-group ">Kode
                                Perihal</label>
                            <input type="name" name="kode" class="form-control" id="kodePerihal">
                        </div>
                        <div class="row text-center" style="padding-bottom: 50px;">
                            <div class="col-md-6">
                                <a href="<?php echo base_url('admin/kategori/perihal/') ?><?= $kategori['slug']; ?>">
                                    <button class="btn btn-danger" type="button" style="width: 150px;"
                                        data-dismiss="modal">Batal</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success " style="width: 150px;">Tambah
                                    data</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dismissButton = document.getElementById("dismissError");
    const errorAlert = document.querySelector(".alert.alert-danger");

    dismissButton.addEventListener("click", function() {
        errorAlert.style.display = "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
    });
});
</script>
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

<?= $this->endSection('content'); ?>"