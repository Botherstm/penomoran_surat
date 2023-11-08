<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

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
                <button id="dismissError" class="btn btn-dark" style="width: 10%;" >Hide</button>
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

            <div class="card card-success">


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Generate Nomor Surat</h3>
                </div>
                <div class="card-body">
                <form class="card-body text-center" action="<?php echo base_url('generate/save') ?>" method="post" enctype="multipart/form-data" id="generateForm">
                                <div class="form-group">
                                    <label for="tanggalSurat">Tanggal Surat</label>
                                    <input type="date" name="tanggal" value="<?= $tanggalmax; ?>" max="<?= $tanggalmax; ?>" class="form-control" id="tanggalSurat" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Dinas</label>
                                    <input type="name" value="<?= $dinas['name']; ?>" class="form-control form-control-border" name="instansi" id="dinas" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Bidang</label>
                                    <input type="text" value="<?= $bidang['name']; ?>" class="form-control" name="bidang" id="bidang" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Urutan Surat</label>
                                    <input type="text" value="<?= $urutanPlusOne; ?>" class="form-control" name="urutan" id="urutan" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <div class="input-group">
                                        <select class="custom-select" required name="kategori" id="kategori">
                                            <option>Pilih kategori...</option>
                                            <?php foreach ($kategories as $kategori) : ?>
                                                <option value="<?= $kategori['kode'] ?>"><?= $kategori['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="perihalGroup">
                                    <label for="perihal">Perihal</label>
                                    <div class="input-group">
                                        <select class="custom-select" name="perihal" id="perihal">
                                            <option selected>Pilih perihal...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="subPerihalGroup">
                                    <label for="subPerihal">Sub Perihal</label>
                                    <div class="input-group">
                                        <select class="custom-select" name="subperihal" id="subPerihal">
                                            <option selected>Pilih sub perihal...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="detailSubPerihalGroup">
                                    <label for="detailsubPerihal">Detail Sub Perihal</label>
                                    <div class="input-group">
                                        <select class="custom-select" name="detailsubperihal_id" id="detailsubPerihal">
                                            <option selected>Pilih detail sub perihal...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Nomor Tercetak</label>
                                    <input type="text" required name="nomor" class="form-control" id="nomorSurat" readonly>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" type="button" id="generateButton" onclick="confirmGenerate()" style="width: 100px;">Generate</button>
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