<?= $this->extend('user/layouts/main'); ?>

<?= $this->section('content'); ?>

<div>
    <div class="content-wrapper" style="padding-top:1%; padding-left: 1% ">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Data User</h5>
                    </div>
                    <table class="table table-borderless">
                        <tr style="padding-left: 1%;">
                            <td>NIP</td>
                            <td>:</td>
                            <td>2015051090</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td>I GEDE ARYA YASODA PUTRA</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir, Tanggal Lahir</td>
                            <td>:</td>
                            <td>Kab. Gianyar, 2002-01-07</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>Laki-laki</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>Hindu</td>
                        </tr>

                        <tr>
                            <td>Nomor KTP</td>
                            <td>:</td>
                            <td>12345678909876</td>
                        </tr>

                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>Pegawai</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>:</td>
                            <td>08123456789</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="" class="btn btn-info"><i class="icon-pencil7"></i> Ubah Profil</a>
                    </div>
                    <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="" class="btn btn-info"><i class="icon-printer"></i> Cetak Biodata</a>
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

            </div>
        </div>
    </div>


</div>


<?= $this->endSection('content'); ?>