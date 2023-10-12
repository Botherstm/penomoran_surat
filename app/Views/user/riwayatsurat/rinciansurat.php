<?= $this->extend('user/layouts/main'); ?>

<?= $this->section('content'); ?>



<div>
    <div class="content-wrapper" style="padding-top:1%; padding-left: 1% ">
        <div class="row">

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
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-info">Download</button>
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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Rincian Surat</h5>
                    </div>
                    <table class="table table-borderless">
                        <tr style="padding-left: 1%;">
                            <th>Kategori Surat</th>
                            <td>:</td>
                            <td> ... </td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat</th>
                            <td>:</td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <th>Acara Kegiatan</th>
                            <td>:</td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <th>No. Surat</th>
                            <td>:</td>
                            <td>...</td>
                        </tr>

                    </table>
                    <hr>
                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="#" class="btn btn-info" id="ubahUsernameBtn"><i class="icon-pencil7"></i> Ganti Username</a>
                    </div>
                    <div id="formUbahUsername" style="display: none; margin-left:6%;">
                        <form method="" action="">
                            <label for="newUsername">Edit Surat</label><br>
                            <input type="text" name="newUsername" id="newUsername" required>
                        </form>
                        <button type="submit" class="btn btn-outline-info mt-1">Konfirmasi</button>
                    </div>

                    <br>
                </div>
            </div>

        </div>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#ubahUsernameBtn").click(function(e) {
            e.preventDefault(); // Untuk mencegah tindakan bawaan dari tautan

            $("#formUbahUsername").toggle();
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