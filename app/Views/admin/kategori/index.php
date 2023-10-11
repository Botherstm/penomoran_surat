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
</style>

<div class="halpad content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6 ">
                    <h1 class=" font-weight-bold ">List Kategori</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">
            <div class="card-tools">

                <div class="btnadd">
                    <a href="<?php echo base_url('admin/kategori/create') ?>">
                        <button type="button" class="btn btn-success">
                            <i class="icon-jarak fas fa-plus"></i>
                            Tambah
                        </button>
                    </a>

                </div>
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
                <table class="table table-bordered table-hover text-nowrap table-light">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Kode Kategori</th>
                            <th>Data Perihal</th>
                            <th>Rincian Perihal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($kategoris as $kategori) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $kategori['name']; ?></td>
                            <td><?= $kategori['kode']; ?></td>
                            <td>
                                <?php $PerihalCounter = 1; ?>
                                <?php foreach ($perihals[$kategori['id']] as $perihal) : ?>
                                <?= $PerihalCounter++ . '. ' . $perihal['name'] . '<br>'; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <div>
                                    <a href="<?php echo base_url() ?>admin/perihal/<?= $kategori['slug']; ?>">
                                        <button type="button" class="btn btn-dark">
                                            Lihat rincian perihal
                                        </button>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group ">
                                    <!-- update -->
                                    <a class="btnr"
                                        href="<?php echo base_url() ?>admin/kategori/edit/<?= $kategori['slug']; ?>">
                                        <button type="button" class="btn btn-block btn-warning ">
                                            <i class=" fas fa-pen"></i>
                                        </button>
                                    </a>
                                    <form id="deleteForm" class="mr-3"
                                        action="<?php echo base_url() ?>admin/kategori/delete/<?= $kategori['slug']; ?>"
                                        method="POST">
                                        <?= csrf_field(); ?>
                                        <button type="button" onclick="confirmDelete('<?= $kategori['slug']; ?>')"
                                            class="btn btn-block btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
<script>
// function showAlert() {
//     Swal.fire('Ini adalah pesan SweetAlert2!');
// }

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
            form.action = "<?php echo base_url() ?>admin/kategori/delete/" + slug;
            form.submit();
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