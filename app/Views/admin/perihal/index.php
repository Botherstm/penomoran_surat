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
            <div class="row jarak">
                <div>
                    <h1 class="m-0 font-weight-bold ">List Perihal </h1>
                    <h1 class="m-0 font-weight-bold "> <?= $kategori['name']; ?></h1>
                </div><!-- /.col -->
                <div class="card-tools">

                    <div class="btnadd">
                        <a href="<?php echo base_url('admin/kategori') ?>">
                            <button type="button" class="btn btn-warning" style="border: 2px solid black;">
                                <i class="icon-jarak fa fa-chevron-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">
            <div class="card-tools">
                <div class="btnadd">
                    <a href="<?php echo base_url('admin/kategori/perihal/create/') ?><?= $kategori['slug']; ?>">
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
                            <th>Nama Perihal</th>
                            <th>Kode</th>
                            <th>Data SubPerihal</th>
                            <th>Rincian Sub Perihal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($perihals as $perihal) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $perihal['name']; ?></td>
                            <td><?= $perihal['kode']; ?></td>
                            <td>
                                <?php $subPerihalCounter = 1; ?>
                                <?php foreach ($subPerihals[$perihal['id']] as $subPerihal) : ?>
                                <?= $subPerihalCounter++ . '. ' . $subPerihal['name'] . '<br>'; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <div>
                                    <a
                                        href="<?php echo base_url('admin/kategori/perihal/subperihal/') ?><?= $perihal['slug']; ?>">
                                        <button type="button" class="btn btn-dark">
                                            Lihat rincian sub perihal
                                        </button>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group ">
                                    <!-- update -->
                                    <a class="btnr"
                                        href="<?php echo base_url('admin/kategori/perihal/edit/') ?><?= $perihal['slug']; ?>">
                                        <button type="button" class="btn btn-block btn-warning ">
                                            <i class=" fas fa-pen"></i>
                                        </button>
                                    </a>
                                    <form id="deleteForm" class="mr-3"
                                        action="<?php echo base_url('admin/perihal/delete/') ?><?= $perihal['slug']; ?>"
                                        method="POST">
                                        <?= csrf_field(); ?>
                                        <button type="button" onclick="confirmDelete('<?= $perihal['slug']; ?>')"
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
            form.action = "<?php echo base_url('admin/perihal/delete/') ?>" + slug;
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