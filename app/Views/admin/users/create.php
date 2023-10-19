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
            <h1 class="m-0 font-weight-bold">Tambah User</h1>
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
    <div class="btnadd">               
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#generateModal">
                            <i class="icon-jarak fas fa-plus"></i>
                            Tambah
                        </button>
    

                </div>
        <form method="POST" action="<?php echo base_url('admin/users/save') ?>">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" name="name" required class="form-control" id="name" placeholder="Masukkan Nama">
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
                <input type="number" name="no_hp" required class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukan No. Telp">
            </div>
            <?php if(session()->get('level') == 1): ?>
            <input type="name" hidden value="<?= session()->get('instansi_id') ?>" name="instansi_id">
            <div class="form-group">
                <label for="bidangSelect">Bidang</label>
                <select class="form-control" id="bidangSelect" name="bidang_id">
                    <?php foreach ($bidangs as $bidang) : ?>
                    <option value="<?= $bidang['id'] ?>"><?= $bidang['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php elseif(session()->get('level') == 2): ?>
            <div class="form-group">
                <label for="instansiSelect">Dinas</label>
                <select class="form-control" id="instansiSelect" name="instansi_id">
                    <?php foreach ($instansis as $dinas) : ?>
                    <option value="<?= $dinas['id'] ?>"><?= $dinas['name'] ?></option>
                    <?php endforeach; ?>
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
            <?php endif; ?>

            <div class="form-group">
                <label for="Password1">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" required id="Password1"
                        placeholder="Password">
                    <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="InputPassword2">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="confirm_password" class="form-control" id="InputPassword2"
                        placeholder="Confirm Password">
                    <span class="input-group-text" id="toggleConfirmPassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>
            <div class="text-danger" id="passwordMatchError" style="display: none;">Password tidak cocok.</div>

            <div class="row text-center" style="padding-bottom: 50px;">
                <div class="col-md-6">
                    <a href="<?php echo base_url('admin/users') ?>">
                        <button type="button" class="btn btn-danger" style="width: 150px;">Batal</button>
                    </a>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success " style="width: 150px;">Tambah data</button>
                </div>
            </div>

        </form>

<form>
<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Generate Nomor Surat</h3>
                    </div>
                    <div class="card-body">
                        <form class="card-body" action="<?php echo base_url('generate/save') ?>" method="post"
                            enctype="multipart/form-data" id="generateForm">
                            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" name="name" required class="form-control" id="name" placeholder="Masukkan Nama">
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
                <input type="number" name="no_hp" required class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukan No. Telp">
            </div>

            <?php if(session()->get('level') == 1): ?>
            <input type="name" hidden value="<?= session()->get('instansi_id') ?>" name="instansi_id">
            <div class="form-group">
                <label for="bidangSelect">Bidang</label>
                <select class="form-control" id="bidangSelect" name="bidang_id">
                    <?php foreach ($bidangs as $bidang) : ?>
                    <option value="<?= $bidang['id'] ?>"><?= $bidang['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php elseif(session()->get('level') == 2): ?>
            <div class="form-group">
                <label for="instansiSelect">Dinas</label>
                <select class="form-control" id="instansiSelect" name="instansi_id">
                    <?php foreach ($instansis as $dinas) : ?>
                    <option value="<?= $dinas['id'] ?>"><?= $dinas['name'] ?></option>
                    <?php endforeach; ?>
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
            <?php endif; ?>

            <div class="form-group">
                <label for="Password1">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" required id="Password1"
                        placeholder="Password">
                    <span class="input-group-text" id="togglePassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="InputPassword2">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="confirm_password" class="form-control" id="InputPassword2"
                        placeholder="Confirm Password">
                    <span class="input-group-text" id="toggleConfirmPassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="text-danger" id="passwordMatchError" style="display: none;">Password tidak cocok.</div>

            <div class="row text-center" style="padding-bottom: 50px;">
                <div class="col-md-6">
                    <a href="<?php echo base_url('admin/users') ?>">
                        <button type="button" class="btn btn-danger" style="width: 150px;">Batal</button>
                    </a>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success " style="width: 150px;">Tambah data</button>
                </div>
            </div>

                            <div class="form-group">
                                <label for="nomorSurat">Dinas</label>
                                <input type="name" value="<?=$dinas['name'];?>" class="form-control form-control-border"
                                    name="instansi" id="dinas" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nomorSurat">Bidang</label>
                                <input type="text" value="<?=$bidang['name'];?>" class="form-control" name="bidang"
                                    id="bidang" readonly>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

</form>

    </section>
    <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script>
<?php if (session()->getFlashdata('error')) : ?>
Swal.fire({
    title: 'Gagal',
    text: '<?= session()->getFlashdata('error') ?>',
    icon: 'warning',
    timer: 3000,
    showConfirmButton: false
});
<?php endif; ?>

var nameInput = document.getElementById('name');
var slugInput = document.getElementById('slug');
const passwordInput = document.getElementById("Password1");
const confirmInput = document.getElementById("InputPassword2");
const togglePasswordButton = document.getElementById("togglePassword");
const toggleConfirmPasswordButton = document.getElementById("toggleConfirmPassword");
const passwordMatchError = document.getElementById("passwordMatchError");
const submitButton = document.querySelector("button[type=submit]");

//slug
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .substring(0, 50);
}


nameInput.addEventListener('input', function() {
    var nameValue = nameInput.value;
    var slugValue = slugify(nameValue);
    slugInput.value = slugValue;
});


//tombol mata
togglePasswordButton.addEventListener("click", function() {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
        passwordInput.type = "password";
        togglePasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }
});
toggleConfirmPasswordButton.addEventListener("click", function() {
    if (confirmInput.type === "password") {
        confirmInput.type = "text";
        toggleConfirmPasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
        confirmInput.type = "password";
        toggleConfirmPasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }
});

passwordInput.addEventListener("input", validatePassword);
confirmInput.addEventListener("input", validatePassword);

function validatePassword() {
    const password = passwordInput.value;
    const confirm = confirmInput.value;

    if (password === confirm) {
        passwordMatchError.style.display = "none";
    } else {
        passwordMatchError.style.display = "block";
    }
}


//validate password


passwordInput.addEventListener("input", validatePassword);

confirmInput.addEventListener("input", validatePassword);

function validatePassword() {
    const password = passwordInput.value;
    const confirm = confirmInput.value;

    if (password === confirm) {

        submitButton.disabled = false;
    } else {

        submitButton.disabled = true;
    }
}
</script>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>