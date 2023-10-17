<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<div>
    <div class="content-wrapper" style="padding-top:1%; padding-left: 1% ">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">DATA USER</h5>
                    </div>
                    <table class="table table-borderless">
                        <tr style="padding-left: 1%;">
                            <th>NIP</th>
                            <td>:</td>
                            <td>2015051090</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>:</td>
                            <td>nama lengkap</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir, Tanggal Lahir</th>
                            <td>:</td>
                            <td>Indonesia, 2000-01-01</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:</td>
                            <td>Laki-laki</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>:</td>
                            <td>Hindu</td>
                        </tr>

                        <tr>
                            <th>Nomor KTP</th>
                            <td>:</td>
                            <td>12345678909876</td>
                        </tr>

                        <tr>
                            <th>Jabatan</th>
                            <td>:</td>
                            <td>Pegawai</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>:</td>
                            <td>08123456789</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="#" class="btn btn-info" id="ubahNamaBtn"><i class="icon-pencil7"></i> Ganti Nama</a>
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


                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="#" class="btn btn-info" id="ubahEmailBtn"><i class="icon-pencil7"></i> Ganti Email</a>
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


                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="#" class="btn btn-info" id="ubahPasswordBtn"><i class="icon-pencil7"></i> Ganti Password</a>
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
                        <div class="text-center ">
                            <img src="" id="sample_image" style="width: 50%;" />
                        </div>
                    </div>

                    <div class="card-footer">
                        <form method="POST" action="" accept-charset="UTF-8" id="form_photo" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="hylqApcELmsucQ2kZKl4yvR3fqC0wkBgKDQa3IAn">
                            <div class="row">
                                <label class="col-form-label col-md-3 text-right">Ganti Foto : </label>
                                <div class="col-md-6">
                                    <input type="file" name="fileUpload" accept="image/*" required id="upload_image" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3 text-right" style="margin-right: 3%;">
                    <button class="btn btn-outline-info" id="tombolBaru"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg> Kembali</button>
                </div>
            </div>
        </div>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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