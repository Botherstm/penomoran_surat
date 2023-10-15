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
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6 px-4">
                    <h1 class="m-0 font-weight-bold ">List Users</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">
            <div class="card-tools">

                <div class="btnadd">
                    <a href="<?php echo base_url('admin/users/create') ?>">
                        <button type="button" class="btn btn-success">
                            <i class="icon-jarak fas fa-plus"></i>
                            Tambah
                        </button>
                    </a>

                </div>
            </div>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="searchInput" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="button" id="searchButton" class="btn btn-default">
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No.Telp</th>
                            <th>Dinas</th>
                            <th>Bidang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($users as $user) : ?>
                        <?php if (session()->get('level') == 2 || $user['level'] != 2) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $user['nip']; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['no_hp']; ?></td>
                            <td><?= $user['instansi_id']; ?></td>
                            <td>
                                <?php
                                    $bidangNames = [];
                                    foreach ($bidangs as $bidangId => $bidang) {
                                        if ($bidangId == $user['bidang_id']) {
                                            $bidangNames[] = $bidang['name'];
                                        }
                                    }
                                    echo implode(', ', $bidangNames);     
                                ?>
                            </td>
                            <td>
                                <div class="btn-group ">
                                    <!-- update -->
                                    <a class="btnr"
                                        href="<?php echo base_url('admin/users/edit/') ?><?= $user['slug']; ?>">
                                        <button type="button" class="btn btn-block btn-warning ">
                                            <i class=" fas fa-pen"></i>
                                        </button>
                                    </a>
                                    <?php if (session()->get('name') == $user['name']) : ?>
                                    <!-- Sembunyikan tombol delete jika user saat ini adalah pemilik data -->
                                    <?php else : ?>
                                    <form id="deleteForm" class="pr-3"
                                        action="<?php echo base_url('admin/users/delete/') ?><?= $user['slug']; ?>"
                                        method="POST">
                                        <?= csrf_field(); ?>
                                        <button type="button" onclick="confirmDelete('<?= $user['slug']; ?>')"
                                            class="btn btn-block btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
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
            form.action = "<?php echo base_url('admin/users/delete/') ?>" + slug;
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







function performSearch() {
    // Ambil nilai dari input pencarian
    var searchText = document.getElementById('searchInput').value.toLowerCase();

    // Ambil semua baris data dalam tabel
    var tableRows = document.querySelectorAll('.table tbody tr');

    // Loop melalui setiap baris data
    tableRows.forEach(function(row) {
        var rowData = row.textContent.toLowerCase();
        if (rowData.includes(searchText)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Tambahkan event listener pada tombol pencarian
document.getElementById('searchButton').addEventListener('click', performSearch);

// Tambahkan event listener pada input pencarian untuk mendukung pencarian instan saat mengetik
document.getElementById('searchInput').addEventListener('input', performSearch);
</script>
<?= $this->endSection('content'); ?>