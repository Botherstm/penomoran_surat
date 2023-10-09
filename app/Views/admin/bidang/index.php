<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content'); ?>
<style>
.table-container {
    animation: fadeInUp 1s ease;
}

.table>tbody>tr>* {
    vertical-align: middle;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<div class="col-sm-6">
    <h2 class="m-0">Data Bidang </h2>
</div>
<div class="table-container">
    <div class="py-2 px-2">
        <a href="<?php echo base_url() ?>admin/bidang/create">
            <div class="btn btn-dark">Tambah Data</div>
        </a>
    </div>
    <?php if (!empty($bidangs)) : ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Instansi</th>
                <th class="text-center">Kode Surat</th>
                <th class="text-center">Bidang</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Detail Kategori</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($bidangs as $bidang) : ?>
            <tr class="text-center">
                <td><?= $i++; ?></td>
                <td><?= $bidang['kode'] ?></td>
                <td><?= $bidang['name'] ?></td>

                <td>
                    <div class="py-2 px-2">
                        <a href="<?php echo base_url() ?>admin/kategory/<?= $bidang['id'] ?>">
                            <div class="btn btn-dark">Lihat Data Kategori</div>
                        </a>
                    </div>
                </td>

                <td>
                    <div class="btn-group">
                        <a href="/admin/pages/bidang/detail/<?= $bidang['name']; ?>">
                            <button type="button" class="btn btn-outline-success">
                                <i class="bi bi-eye"></i>
                            </button>
                        </a>
                        <a href="/admin/pages/bidang/edit/<?= $bidang['name']; ?>">
                            <button type="button" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </a>
                        <form id="deleteForm<?= $bidang['id']; ?>"
                            action="/admin/pages/bidang/delete/<?= $bidang['id']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete(<?= $bidang['id']; ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <h3>belum ada data</h3>
    <?php endif ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(albumId) {
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
            document.getElementById('deleteForm' + albumId).submit();
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
<?php
// Fungsi untuk mendapatkan nama instansi berdasarkan instansi_id
?>
</script>

<?= $this->endSection('content'); ?>