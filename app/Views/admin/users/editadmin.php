<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

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
                                    <td><?=$user['name'];?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?=$user['email'];?></td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>:</td>
                                    <td><?=$user['no_hp'];?></td>
                                </tr>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <td>:</td>
                                    <td><?=$dinas['name'];?></td>
                                </tr>

                                <tr>
                                    <th>Bidang</th>
                                    <td>:</td>
                                    <td><?=$bidang['name'];?></td>
                                </tr>
                            </table>
                            <hr>
                            <div class="header-elements" style="margin-left:5%; padding:1%; ">
                                <a href="#" class="btn btn-info" style="width: 150px;" id="ubahNamaBtn"><i
                                        class="icon-pencil7"></i> Ganti Nama</a>
                            </div>
                            <div id="formUbahNama" style="display: none; margin-left:6%;">
                                <form method="" action="">
                                    <label for="oldNama">Nama Lama:</label><br>
                                    <input type="text" name="oldNama" id="oldNama" required>
                                </form>
                                <form method="" action="">
                                    <label for="newNama">Nama Baru:</label><br>
                                    <input type="text" name="newNama" id="newNama" required>
                                </form>
                                <button type="submit" class="btn btn-outline-info mt-1">Konfirmasi</button>
                            </div>


                            <div class="header-elements" style="margin-left:5%; padding:1%; ">
                                <a href="#" class="btn btn-info" id="ubahEmailBtn" style="width: 150px;"><i
                                        class="icon-pencil7"></i> Ganti Email</a>
                            </div>
                            <div id="formUbahEmail" style="display: none; margin-left:6%;">
                                <form method="" action="">
                                    <label for="oldEmail">Email Lama:</label><br>
                                    <input type="text" name="oldEmail" id="oldEmail" required>
                                </form>
                                <form method="" action="">
                                    <label for="newEmail">Email Baru:</label><br>
                                    <input type="text" name="newEmail" id="newEmail" required>
                                </form>
                                <button type="submit" class="btn btn-outline-info mt-1">Konfirmasi</button>
                            </div>


                            <div class="header-elements" style="margin-left:5%; padding:1%;">
                                <a href="#" class="btn btn-info" id="ubahPasswordBtn" style="width: 150px;"><i
                                        class="icon-pencil7"></i> Ganti Password</a>
                            </div>
                            <div id="formUbahPassword" style="display: none; margin-left:6%;">
                                <form method="" action="">
                                    <label for="oldPassword">Password Lama:</label><br>
                                    <input type="text" name="oldPassword" id="oldPassword" required>
                                </form>
                                <form method="" action="">
                                    <label for="newPassword">Password Baru:</label><br>
                                    <input type="text" name="newPassword" id="newPassword" required>
                                </form>
                                <button type="submit" class="btn btn-outline-info mt-1">Konfirmasi</button>
                            </div>

                            <br>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 1%;">
                        <div class="card">

                            <div class="card-body">
                                <?php if (!empty($user['gambar'])): ?>
                                <div class="text-center ">
                                    <img src="<?php echo base_url('userimage/') ?><?=$user['gambar'];?>" alt=""
                                        width="70%">
                                </div>
                                <?php else: ?>
                                <div class="text-center ">
                                    <img src="/img/profile.jpg" alt="" width="70%">
                                </div>
                                <?php endif?>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-9 offset-md-3">
                                    <img id="image_preview" src="" alt="" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                            <div class="card-footer">
                                <form method="POST" action="<?php echo base_url('admin/profile/update') ?>"
                                    accept-charset="UTF-8" id="form_photo" enctype="multipart/form-data">
                                    <div class="row">
                                        <label class="col-form-label col-md-3 text-right">Ganti Foto : </label>
                                        <div class="col-md-6">
                                            <input type="text" hidden value="<?=$user['id'];?>" name="id">
                                            <input type="file" name="gambar" accept="image/*" required id="upload_image"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3 text-right" style="margin-right: 3%;">
                            <a href="/" class="btn btn-outline-info" id="tombolBaru">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                </svg> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>.
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    title: 'Success',
    text: '<?=session()->getFlashdata('success')?>',
    icon: 'success',
    timer: 3000,
    showConfirmButton: false
});
<?php endif;?>

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
<?=$this->endSection('content');?>