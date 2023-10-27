<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="" style="padding-top:1%; ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">DATA USER</h5>
                            </div>
                            <table class="table table-borderless">
                                <tr style="padding-left: 1%;">
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td><?= $user['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?= $user['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>:</td>
                                    <td><?= $user['no_hp']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <td>:</td>
                                    <td><?= $dinas['name']; ?></td>
                                </tr>

                                <tr>
                                    <th>Bidang</th>
                                    <td>:</td>
                                    <td><?= $bidang['name']; ?></td>
                                </tr>
                            </table>
                            <hr>
                            <div class=" mx-auto " style="padding-bottom: 10%; padding-top: 10%; ">
                                <div class="header-elements" style="margin-left:5%; padding:1%; ">
                                    <a href="#<?= $user['slug']; ?>" class="btn btn-info" style="width: 200px;" data-toggle="modal" data-target="#editModal"><i class="icon-pencil7"></i> Ganti Data User</a>

                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 1%;">
                        <div class="card">

                            <div class="card-body">
                                <?php if (!empty($user['gambar'])) : ?>
                                    <div class="text-center ">
                                        <img src="<?php echo base_url('userimage/') ?><?= $user['gambar']; ?>" alt="" width="70%">
                                    </div>
                                <?php else : ?>
                                    <div class="text-center ">
                                        <img src="/img/profile.jpg" alt="" width="70%">
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-9 offset-md-3">
                                    <img id="image_preview" src="" alt="" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <form method="POST" action="<?php echo base_url('admin/profile/update') ?>" accept-charset="UTF-8" id="form_photo" enctype="multipart/form-data">
                                    <div class="row">
                                        <label class="col-form-label col-md-3 text-right">Ganti Foto : </label>
                                        <div class="col-md-6">
                                            <input type="text" hidden value="<?= $user['id']; ?>" name="id">
                                            <input type="file" name="gambar" accept="image/*" required id="upload_image" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="btn-group">
                                    <!-- update -->
                                    <form id="deleteForm" action="<?php echo base_url('admin/profile/delete') ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="text" hidden value="<?= $user['id']; ?>" name="id">
                                        <button type="button" onclick="confirmDelete('')" class="btn btn-block btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>.
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
                            <label for="exampleFormControlSelect1">Dinas</label>
                            <select class="form-control" name="bidang_id" id="exampleFormControlSelect1">
                                <option value="<?= $bidang['id']; ?>"><?= $bidang['name']; ?></option>

                            </select>
                        </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bidang</label>
                        <select class="form-control" name="bidang_id" id="exampleFormControlSelect1">
                            <option value="<?= $bidang['id']; ?>"><?= $bidang['name']; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" value="<?= $user['password'] ?>" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Password">
                    </div>

                    <div class="form-group">
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" value="<?= $user['password'] ?>" name="password" class="form-control" id="exampleFormControlInput1" placeholder=" ">
                    </div>

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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Apa Kamu yakin?',
            text: 'Jika dihapus Foto tidak bisa di kembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = "<?php echo base_url('admin/profile/delete') ?>";
                form.submit();
            }
        });
    }
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Success',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>

    document.getElementById('upload_image').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image_preview').src = '';
        }
    });


    $(document).ready(function() {
        $("#ubahNamaBtn").click(function(e) {
            e.preventDefault(); // Untuk mencegah tindakan bawaan dari tautan

            $("#formUbahNama").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#ubahEmailBtn").click(function(e) {
            e.preventDefault(); // Untuk mencegah tindakan bawaan dari tautan

            $("#formUbahEmail").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#ubahPasswordBtn").click(function(e) {
            e.preventDefault(); // Untuk mencegah tindakan bawaan dari tautan

            $("#formUbahPassword").toggle();
        });
    });
</script>
<?= $this->endSection('content'); ?>