<?= $this->extend('public/layouts/main'); ?>


<?= $this->section('content'); ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="" style="padding-top:1%; ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">Tentang Aplikasi</h5>
                            </div>
                            <table class="table table-borderless">
                                <tr style="padding-left: 1%;">
                                    <th>Nama</th>
                                    <td>:</td>
                                </tr>

                            </table>
                            <hr>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">Tentang Aplikasi</h5>
                            </div>
                            <table class="table table-borderless">
                                <tr style="padding-left: 1%;">
                                    <th>Nama</th>
                                    <td>:</td>
                                </tr>

                            </table>
                            <hr>

                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 1%;">
                        <div class="card">

                            <div class="card-body">

                                <div class="text-center ">
                                    <img src="" alt="" width="70%">
                                </div>

                                <div class="text-center ">
                                    <img src="/img/profile.jpg" alt="" width="70%">
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-9 offset-md-3">
                                    <img id="image_preview" src="" alt="" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <form method="POST" action="" accept-charset="UTF-8" id="form_photo" enctype="multipart/form-data">
                                    <div class="row">
                                        <label class="col-form-label col-md-3 text-right">Ganti Foto : </label>
                                        <div class="col-md-6">
                                            <input type="text" hidden value="" name="id">
                                            <input type="file" name="gambar" accept="image/*" required id="upload_image" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="btn-group">
                                    <!-- update -->
                                    <form id="deleteForm" action="" method="POST">

                                        <input type="text" hidden value="" name="id">
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

<?= $this->endSection('content'); ?>