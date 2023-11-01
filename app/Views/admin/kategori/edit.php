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
                    <h3 class="card-title" style="font-weight: bold;">Edit Data Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="editForm">
                        <?=csrf_field();?>

                    <div class="mb-5 m-1">
                        <label for="name" class="form-label input-group ">Kategori</label>
                        <input type="text" name="name" class="form-control" id="editName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-5 m-1">
                        <label for="kodeKategori" class="form-label input-group ">Kode
                            Kategori</label>
                        <input type="text" name="kode" class="form-control" id="editKodeKategori">
                    </div>

                    <!-- Input untuk menyimpan slug -->
                    <input type="hidden" name="slug" id="editSlug">

                    <div class="row text-center">
                            <div class="col-md-6" style="padding-bottom: 10px;">
                                <a
                                    href="<?php echo base_url('admin/kategori') ?>">
                                    <button type="button" class="btn btn-danger" style="width: 150px;  ">Batal</button>
                                </a>
                            </div>
                            <div class="col-md-6" style="padding-bottom: 10px;">
                                <button type="submit" class="btn btn-success "
                                    style="width: 150px; padding-bottom: 10px;">Ubah data</button>
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