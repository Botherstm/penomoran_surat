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
        <div style="padding-top: 20px;">
            <div class="col-sm-12">

                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed"
                    aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending">
                                No</th>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending">
                                Kode Surat</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending">
                                Perihal Surat</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending">
                                Tanggal Surat</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending">
                                Dinas</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending">
                                Bidang</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending">Nama
                                User
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending">Nomor
                                User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1?>
                        <?php foreach ($riwayats as $riwayat): ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td>
                                <span class="copy-text" data-clipboard-text="<?=$riwayat['nomor'];?>"
                                    title="Klik untuk menyalin kode surat">
                                    <?=$riwayat['nomor'];?>
                                </span>
                            </td>
                            <td><?=$riwayat['perihal'];?></td>
                            <td><?=$riwayat['urutan'];?></td>
                            <td><?=$riwayat['tanggal'];?></td>
                            <td>
                                <?php $bidangId = $riwayat['bidang_id'];?>
                                <?php if (isset($bidangs[$bidangId]['name'])): ?>
                                <?=$bidangs[$bidangId]['name'] . '<br>';?>
                                <?php endif;?>
                            </td>
                            <td>
                                <?php $userId = $riwayat['user_id'];?>
                                <?php if (isset($users[$userId]['name'])): ?>
                                <?=$users[$userId]['name'] . '<br>';?>
                                <?php endif;?>
                            </td>
                            <td>
                                <?php $userId = $riwayat['user_id'];?>
                                <?php if (isset($users[$userId]['no_hp'])): ?>
                                <?=$users[$userId]['no_hp'] . '<br>';?>
                                <?php endif;?>
                            </td>

                        </tr>
                        <?php endforeach?>
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