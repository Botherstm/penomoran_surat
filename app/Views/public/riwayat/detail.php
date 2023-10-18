<?= $this->extend('public/layouts/main'); ?>

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

                    <div class="card-footer justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <a href="<?= base_url('pdf/'); ?><?= $generate['pdf']; ?>"> <button type="submit"
                                        class="btn btn-info">Download PDF !</button></a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Rincian Surat</h5>
                    </div>
                    <table class="table table-borderless">
                        <tr style="padding-left: 1%;">
                            <th>Nomor Surat</th>
                            <td>:</td>
                            <td> <?= $generate['nomor']; ?> </td>
                        </tr>
                        <tr style="padding-left: 1%;">
                            <th>Perihal Surat</th>
                            <td>:</td>
                            <td> <?= $generate['perihal']; ?> </td>
                        </tr>
                        <tr>
                            <th>Dinas</th>
                            <td>:</td>
                            <td><?= $dinas['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Bidang</th>
                            <td>:</td>
                            <td><?= $bidang['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat</th>
                            <td>:</td>
                            <td><?= $tanggal; ?></td>
                        </tr>
                        <tr>
                            <th>Nama User</th>
                            <td>:</td>
                            <td><?= $user['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Hp User</th>
                            <td>:</td>
                            <td><?= $user['no_hp']; ?></td>
                        </tr>


                    </table>
                    <hr>
                    <!-- <div class="header-elements" style="margin-left:5%; padding:1%">
                        <a href="#" class="btn btn-info" id="ubahUsernameBtn"><i class="icon-pencil7"></i> Edit
                            Surat</a>
                    </div> -->
                    <div id="formUbahUsername" style="display: none; margin-left:6%;">
                        <form method="" action="">
                            <label for="newUsername">Edit Surat</label><br>
                            <input type="text" name="newUsername" id="newUsername" required>
                        </form>
                        <button type="submit" class="btn btn-outline-info mt-1">Konfirmasi</button>
                    </div>

                    <br>
                </div>
                <div class="mt-3 text-right" style="margin-right: 3%;">
                    <a href="/public/riwayat/">
                        <button class="btn btn-outline-info" id="tombolBaru"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg> Kembali</button>
                    </a>
                </div>
            </div>

        </div>
    </div>


</div>



<?= $this->endSection('content'); ?>