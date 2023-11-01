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
                    <button id="dismissError" class="btn btn-primary">Ok</button>
                </div>
                <?php endif;?>

                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">create User</h3>
                </div>
                <div class="card-body">
                    <form class="card-body" action="<?php echo base_url('admin/users/save') ?>" method="post"
                        enctype="multipart/form-data" id="generateForm">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="text" name="name" required class="form-control" id="name"
                                placeholder="Masukkan Nama">
                        </div>

                        <div class="form-group text-center">
                            <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" name="email" required class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Telp.</label>
                            <input type="number" name="no_hp" required class="form-control"
                                id="exampleFormControlInput1" placeholder="Masukan No. Telp">
                        </div>

                        <?php if (session()->get('level') == 1): ?>
                        <input type="name" hidden value="<?=session()->get('instansi_id')?>" name="instansi_id">
                        <div class="form-group">
                            <label for="bidangSelect">Bidang</label>
                            <select class="form-control" id="bidangSelect" name="bidang_id">
                                <?php foreach ($bidangs as $bidang): ?>
                                <option value="<?=$bidang['id']?>"><?=$bidang['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <?php elseif (session()->get('level') == 2): ?>
                        <div class="form-group">
                            <label for="instansiSelect">Dinas</label>
                            <select class="form-control" id="instansiSelect" name="instansi_id">
                                <?php foreach ($instansis as $dinas): ?>
                                <option value="<?=$dinas['id']?>"><?=$dinas['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="instansiSelect">Level Admin</label>
                            <select class="form-control" id="instansiSelect" name="level">
                                <option selected>Pilih Level Akun ...</option>
                                <option value="2">Super Admin</option>
                                <option value="1">Operator</option>
                            </select>
                        </div>
                        <?php endif;?>
                        <div class="row text-center" style="padding-bottom: 50px;">
                            <div class="col-md-6">
                                <a href="<?=base_url('admin/users');?>">
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
<!-- /.content-wrapper -->
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