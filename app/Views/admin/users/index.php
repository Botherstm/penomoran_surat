<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
    .btnadd {

        padding-left: 17px;
    }

    .btnr {

        padding-inline-end: 15%;

    }

    .icon-jarak {
        padding-right: 10px;
    }

    .jarak {
        justify-content: space-between;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header col">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">

                                <?php if (session()->get('level') == 2) : ?>
                                    <h1 class="card-title">List Users</h1>
                                <?php elseif (session()->get('level') == 1) : ?>
                                    <h1 class="card-title">List Users <?= $dinas['name']; ?></h1>
                                <?php endif ?>

                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#generateModal"><i class="icon-jarak fas fa-user-plus"></i>
                                    Tambah User</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No.Telp</th>
                                    <?php if (session()->get('level') == 2) : ?>
                                        <th>Dinas</th>
                                        <th>Level</th>
                                    <?php elseif (session()->get('level') == 1) : ?>
                                        <th>Bidang</th>
                                    <?php endif ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($users as $user) : ?>
                                    <?php if (session()->get('level') == 2 || $user['level'] != 2) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $user['name']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['no_hp']; ?></td>
                                            <?php if (session()->get('level') == 2) : ?>
                                                <td>
                                                    <?php ?>
                                                    <?php $instansiId = $user['instansi_id']; ?>
                                                    <?php if (isset($dinas[$instansiId]['name'])) : ?>
                                                        <?= $dinas[$instansiId]['name'] . '<br>'; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($user['level'] == 1) : ?>
                                                        <p>Operator</p>
                                                    <?php elseif ($user['level'] == 2) : ?>
                                                        <button disabled class="btn btn-outline-dark">Super Admin</button>
                                                    <?php endif; ?>
                                                </td>
                                            <?php elseif (session()->get('level') == 1) : ?>
                                                <td>
                                                    <?php
                                                    $bidangNames = [];
                                                    foreach ($bidangs as $bidangId => $bidang) {
                                                        if ($bidangId == $user['bidang_id'] && $user['bidang_id'] !== null) {
                                                            $bidangNames[] = $bidang['name'];
                                                        }
                                                    }
                                                    echo implode(', ', $bidangNames);
                                                    ?>
                                                </td>
                                            <?php endif ?>
                                            <td>
                                                <div class="btn-group ">
                                                    <!-- update -->
                                                    <a class="btnr" href="#<?= $user['slug']; ?>">
                                                        <button type="button" class="btn btn-block btn-warning " data-toggle="modal" data-target="#editModal">
                                                            <i class=" fas fa-pen"></i>
                                                        </button>
                                                    </a>

                                                    <form id="deleteForm" class="pr-3" action="<?php echo base_url('admin/users/delete/') ?><?= $user['slug']; ?>" method="POST">
                                                        <?= csrf_field(); ?>
                                                        <button type="button" onclick="confirmDelete('<?= $user['slug']; ?>')" class="btn btn-block btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>
        </div>
    </div>
</div>



<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Akun User</h3>
            </div>
            <div class="card-body">
                <form class="card-body" action="<?php echo base_url('admin/users/save') ?>" method="post" enctype="multipart/form-data" id="generateForm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="text" name="name" required class="form-control" id="name" placeholder="Masukkan Nama">
                    </div>

                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" name="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">No Telp.</label>
                        <input type="number" name="no_hp" required class="form-control" id="exampleFormControlInput1" placeholder="Masukan No. Telp">
                    </div>

                    <?php if (session()->get('level') == 1) : ?>
                        <input type="name" hidden value="<?= session()->get('instansi_id') ?>" name="instansi_id">
                        <div class="form-group">
                            <label for="bidangSelect">Bidang</label>
                            <select class="form-control" id="bidangSelect" name="bidang_id">
                                <?php foreach ($bidangs as $bidang) : ?>
                                    <option value="<?= $bidang['id'] ?>"><?= $bidang['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    <?php elseif (session()->get('level') == 2) : ?>
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
                            <input type="password" name="password" class="form-control" required id="Password1" placeholder="Password">
                            <span class="input-group-text" id="togglePassword">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword2">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" id="InputPassword2" placeholder="Confirm Password">
                            <span class="input-group-text" id="toggleConfirmPassword">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

                    <div class="text-danger" id="passwordMatchError" style="display: none;">Password tidak
                        cocok.</div>
                    <div class="row text-center" style="padding-bottom: 50px;">
                        <div class="col-md-6">
                            <button class="btn btn-danger" type="button" style="width: 150px;" data-dismiss="modal">Batal</button>
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Akun User</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('admin/users/update/') ?><?= $user['id'] ?>">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="text" value="<?= $user['name'] ?>" name="name" class="form-control" id="name" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden value="<?= $user['slug'] ?>" class="form-control" id="slug" name="slug" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" value="<?= $user['email'] ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="no_telp">No Telp.</label>
                        <input type="number" value="<?= $user['no_hp'] ?>" name="no_hp" class="form-control" id="exampleFormControlInput1" placeholder="Masukan No. Telp">
                    </div>

                    <?php if (session()->get('level') == 2) : ?>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Dinas</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="instansi_id">

                            </select>
                        </div>
                    <?php elseif (session()->get('level') == 1) : ?>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bidang</label>
                            <select class="form-control" name="bidang_id" id="exampleFormControlSelect1">
                                <option value="<?= $bidang['id']; ?>"><?= $bidang['name']; ?></option>
                                <?php foreach ($bidangs as $bid) : ?>
                                    <?php if ($bid['id'] == $bidang['id']) : ?>
                                    <?php else : ?>
                                        <option value="<?= $bid['id'] ?>"><?= $bid['name'] ?></option>
                                    <?php endif ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif ?>

                    <div class="row text-center" style="padding-bottom: 50px;">
                        <div class="col-md-6">
                            <button class="btn btn-danger" type="button" style="width: 150px;" data-dismiss="modal">Batal</button>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success " style="width: 150px;">Ubah data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- //create -->
<script>
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
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script>
    // function showAlert() {
    //     Swal.fire('Ini adalah pesan SweetAlert2!');
    // }

    function confirmDelete(slug) {
        Swal.fire({
            title: 'Apa Kamu yakin?',
            text: 'Jika dihapus data tidak bisa di kembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Menggunakan slug yang diterima sebagai bagian dari URL saat mengirim form
                const form = document.getElementById('deleteForm');
                form.action = "<?php echo base_url('admin/users/delete/') ?>" + slug;
                form.submit();
            }
        });
    }

    // Popup success message
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Success',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>


    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
            icon: 'warning',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>








    function performSearch() {
        // Ambil nilai dari input pencarian
        var searchText = document.getElementById('searchInput').value.toLowerCase();

        // Ambil semua baris data dalam tabel
        var tableRows = document.querySelectorAll('.table tbody tr');

        // Loop melalui setiap baris data
        tableRows.forEach(function(row) {
            var rowData = row.textContent.toLowerCase();
            if (rowData.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    document.getElementById('searchButton').addEventListener('click', performSearch);
    document.getElementById('searchInput').addEventListener('input', performSearch);
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

<?= $this->endSection('content'); ?>