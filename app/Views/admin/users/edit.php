<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

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


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Edit User</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('admin/users/update/') ?><?= $user['id'] ?>">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="text" value="<?= esc(session('data.name') ?? $user['name'] ) ?>" name="name"
                                class="form-control" id="name" placeholder="Masukkan NIP">
                            <?php if(session("errors.name")): ?>
                            <div class="text-danger"><?= esc(session("errors.name")) ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group text-center">
                            <input type="name" hidden value="<?= $user['slug'] ?>" class="form-control" id="slug"
                                name="slug" readonly>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" readonly value="<?= $user['username'] ?>" name="username"
                                class="form-control">
                            <?php if(session("errors.username")): ?>
                            <div class="text-danger"><?= esc(session("errors.username")) ?></div>
                            <?php endif ?>
                        </div>


                        <div class="form-group">
                            <label for="no_telp">No Telp.</label>
                            <input type="number" value="<?= $user['no_hp'] ?>" name="no_hp" class="form-control"
                                id="exampleFormControlInput1" placeholder="Masukan No. Telp">
                        </div>


                        <?php if($user['level'] == 1): ?>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Dinas</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="instansi_id">
                                <option value="<?=$instansi['id'] ?>"><?= $instansi['name'] ?></option>
                                <?php foreach ($instansis as $dinas) : ?>
                                <?php if ($dinas['id'] == $instansi['id']) : ?>
                                <?php else: ?>
                                <option value="<?= $dinas['id'] ?>"><?= $dinas['name'] ?></option>
                                <?php endif ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bidang</label>
                            <select class="form-control" name="bidang_id" id="exampleFormControlSelect1">
                                <option value="<?= $bidang['id']; ?>"><?= $bidang['name']; ?></option>
                                <?php foreach ($bidangs as $bid) : ?>
                                <?php if ($bid['id'] == $bidang['id']) : ?>
                                <?php else: ?>
                                <option value="<?= $bid['id'] ?>"><?= $bid['name'] ?></option>
                                <?php endif ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif ?>

                        <div class="row text-center" style="padding-bottom: 30px; padding-top: 20px;">
                            <div class="col-md-6 d-flex" style="justify-content: start;">
                                <a href="<?php echo base_url('admin/users') ?>">
                                    <button type="button" class="btn btn-danger" style="width: 150px;">Batal</button>
                                </a>
                            </div>

                            <div class="col-md-6 d-flex" style="justify-content: end;">
                                <button type="submit" class="btn btn-success " style="width: 150px;">Ubah data</button>
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
<?= $this->endSection('content'); ?>