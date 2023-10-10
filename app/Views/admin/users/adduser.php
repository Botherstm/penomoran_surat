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
    padding: 30px 50px 10px 50px;
}
</style>


<div class="content-wrapper halpad">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Tambah User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="<?php echo base_url() ?>admin/users/save">
            <div class="form-group">
                <label for="exampleFormControlInput1">NIP</label>
                <input type="number" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama">
            </div>

            <div class="form-group text-center">
                <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">No Telp.</label>
                <input type="number" name="no_hp" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukan No. Telp">
            </div>

            <div class="form-group">
                <label for="instansiSelect">Dinas</label>
                <select class="form-control" id="instansiSelect" name="instansi_id">
                    <?php foreach ($instansis->data as $dinas) : ?>
                    <option value="<?= $dinas->id_instansi ?>"><?= $dinas->ket_ukerja ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bidangSelect">Bidang</label>
                <select class="form-control" id="bidangSelect" name="bidang_id">
                    <?php foreach ($bidangs as $bidang) : ?>
                    <option value="<?= $bidang['id'] ?>"><?= $bidang['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <div class="row jarak">
                <button type="submit" class="btn btn-danger" style="width: 150px;">Batal</button>
                <button type="submit" class="btn btn-success" style="width: 150px;">Konfirmasi</button>
            </div>
        </form>
    </section>
    <!-- /.content -->
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
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>