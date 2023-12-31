<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
.jarak {
    padding-top: 50px;
    padding-left: 25px;
    padding-right: 25px;
    padding-bottom: 70px;
    justify-content: space-between;
}

.halpad {
    padding: 30px 300px 10px 300px;
    text-align: center;
}

.h1 {
    text-align: center;
}

.content-header {
    padding-bottom: 40px;
}
</style>

<div class="content-wrapper halpad">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <h1 class="m-0 font-weight-bold">Edit User</h1>
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="<?php echo base_url('admin/users/update/') ?><?= $user['id'] ?>">

            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" value="<?= $user['name'] ?>" name="name" class="form-control" id="name"
                    placeholder="Masukkan NIP">
            </div>
            <div class="form-group text-center">
                <input type="name" hidden value="<?= $user['slug'] ?>" class="form-control" id="slug" name="slug"
                    readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" value="<?= $user['email'] ?>" name="email" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="no_telp">No Telp.</label>
                <input type="number" value="<?= $user['no_hp'] ?>" name="no_hp" class="form-control"
                    id="exampleFormControlInput1" placeholder="Masukan No. Telp">
            </div>

            <?php if(session()->get('level') == 2): ?>
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
            <?php elseif(session()->get('level') == 1): ?>
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

            <div class="row text-center" style="padding-bottom: 50px;">
                <div class="col-md-6">
                    <a href="<?php echo base_url('admin/users') ?>">
                        <button type="button" class="btn btn-danger" style="width: 150px;">Batal</button>
                    </a>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success " style="width: 150px;">Ubah data</button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
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