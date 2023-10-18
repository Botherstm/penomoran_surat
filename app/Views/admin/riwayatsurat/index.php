<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
.table td {
    text-align: center;
    background-color: #C5E9DE;

}


.table>thead>tr>* {
    background-color: #20c997;
    text-align: center;
}


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

.halpad {
    padding: 30px 50px 10px 50px;
}

.copy-text:hover {
    cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16"><path d="M5.5 2A.5.5 0 0 0 5 2.5v11a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5V2.5a.5.5 0 0 0-.5-.5h-5zM6 1.5A.5.5 0 0 1 6.5 1h3a.5.5 0 0 1 .5.5V15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V1.5zM11 3a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1.5 6a.5.5 0 0 1 .5.5V10h1.5a.5.5 0 0 1 0 1H10v1.5a.5.5 0 0 1-1 0V11H7.5a.5.5 0 0 1 0-1H9V8.5a.5.5 0 0 1 .5-.5z"/><path fill-rule="evenodd" d="M8.5 0a.5.5 0 0 1 .5.5V3h1a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V4H7.5a.5.5 0 0 1 0-1H8V.5a.5.5 0 0 1 .5-.5z"/><path d="M6 4.5a.5.5 0 0 0-.5.5V6H4.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V7h1.5a.5.5 0 0 0 0-1H6V5.5a.5.5 0 0 0-.5-.5z"/></svg>'), auto;
}
</style>

<div class="content-wrapper halpad">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6 px-4">
                    <h1 class="m-0 font-weight-bold ">List</h1>
                    <h1 class="m-0 font-weight-bold ">Riwayat Surat</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">
            <div class="card-tools">


            </div>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class=" card-body table-responsive p-10">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode. Surat</th>
                            <th>Tanggal Surat</th>
                            <th>User</th>
                            <th>No Hp User</th>
                            <th>Bidang</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($riwayats as $riwayat) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <span class="copy-text" data-clipboard-text="<?= $riwayat['nomor']; ?>"
                                    title="Klik untuk menyalin kode surat">
                                    <?= $riwayat['nomor']; ?>
                                </span>
                            </td>
                            <td><?= $riwayat['tanggal']; ?></td>
                            <td>
                                <?php $userId = $riwayat['user_id']; ?>
                                <?php if (isset($users[$userId]['name'])) : ?>
                                <?=  $users[$userId]['name'] . '<br>'; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $userId = $riwayat['user_id']; ?>
                                <?php if (isset($users[$userId]['no_hp'])) : ?>
                                <?=  $users[$userId]['no_hp'] . '<br>'; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $bidangId = $riwayat['bidang_id']; ?>
                                <?php if (isset($bidangs[$bidangId]['name'])) : ?>
                                <?=  $bidangs[$bidangId]['name'] . '<br>'; ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $riwayat['urutan']; ?></td>
                            <td>
                                <div class="btn-group ">
                                    <a class="btnr" href="<?php echo base_url('admin/riwayatsurat/rinciansurat') ?>">
                                        <button type="button" class="btn btn-block btn-primary ">
                                            <i class=" fas fa-info"></i>
                                        </button>
                                    </a>
                                    <!-- update -->

                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
var clipboard = new ClipboardJS('.copy-text');
clipboard.on('success', function(e) {
    e.clearSelection();
    Swal.fire('Kode Surat Berhasil Di Salin !!');
});
clipboard.on('error', function(e) {
    Swal.fire('gagal meyalin kode');
});

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
            form.action = "<?php echo base_url() ?>admin/users/delete/" + slug;
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
</script>
<?= $this->endSection('content'); ?>