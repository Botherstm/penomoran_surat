<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>


<div class="content-wrapper ">
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

            <div class="card card-success">
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

                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Buat Dinas</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('admin/dinas/update') ?>" method="POST" class="">
                        <?=csrf_field();?>
                        <input type="hidden" name="id" id="editDinasId">
                        <!-- Input untuk menyimpan ID dinas yang akan diedit -->
                        <div class="form-group">
                            <label for="editName" class="form-label input-group ">Nama
                                Dinas</label>
                            <input type="text" class="form-control" name="name" id="editName"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group text-center">
                            <input type="hidden" hidden class="form-control" id="editSlug" name="slug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="editKodeDinas" class="form-label input-group ">Kode
                                Dinas</label>
                            <input type="name" name="kode" class="form-control" id="editKodeDinas">
                        </div>
                        <div class="form-group">
                            <label for="editUrutan" class="form-label input-group ">Urutan Surat
                                Sebelumnya</label>
                            <input type="number" name="urutan" class="form-control" id="editUrutan">
                        </div>

                        <div class="row text-center" style="padding-bottom: 50px;">
                            <div class="col-md-6 d-flex justify-content-start"  >
                                <a href="<?=base_url('admin/dinas');?>">
                                    <button class="btn btn-danger" type="button" style="width: 150px;"
                                        data-dismiss="modal">Batal</button>
                                </a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end" >
                                <button type="submit" class="btn btn-success" style="width: 150px;">Tambah data</button>
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

<?=$this->endSection('content');?>