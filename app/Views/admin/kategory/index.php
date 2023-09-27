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
    <h2 class="m-0">Data Kategory <?= $nama_dinas['name']; ?></h2>
</div>
<div class="table-container">
    <div class="py-2 px-2">
        <a href="/admin/kategory/create/<?= $category ?>">
            <div class="btn btn-dark">Tambah Data</div>
        </a>
    </div>
    <?php if (!empty($categories)) : ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">tipe surat</th>
                <th class="text-center">Kode Surat</th>
                <th class="text-center">urutan Surat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($categories as $cat) : ?>
            <tr class="text-center">
                <td><?= $i++; ?></td>
                <td><?= $cat['name'] ?></td>
                <td><?= $cat['nomor'] ?></td>
                <td><?= $cat['urutan_surat'] ?></td>
                <td>
                    <div class="btn-group">
                        <a href="/admin/pages/cat/detail/<?= $cat['name']; ?>">
                            <button type="button" class="btn btn-outline-success">
                                <i class="bi bi-eye"></i>
                            </button>
                        </a>
                        <a href="/admin/pages/cat/edit/<?= $cat['name']; ?>">
                            <button type="button" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </a>
                        <form id="deleteForm<?= $cat['id']; ?>" action="/admin/pages/cat/delete/<?= $cat['id']; ?>"
                            method="post">
                            <?= csrf_field(); ?>
                            <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete(<?= $cat['id']; ?>)">
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
</script>

<?= $this->endSection('content'); ?>