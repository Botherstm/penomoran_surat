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
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6 px-4">
                    <?php if(session()->get('level') == 2): ?>
                    <h1 class="m-0 font-weight-bold ">List Users</h1>
                    <?php elseif(session()->get('level') == 1): ?>
                    <h1 class="m-0 font-weight-bold ">List Users <?= $dinas['name']; ?></h1>
                    <?php endif ?>
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
              
            </div>
        </div>
        <div class="card" style="width: 150%;" >


<div class="card-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No.Telp</th>
                            <?php if(session()->get('level') == 2): ?>
                            <th>Dinas</th>
                            <th>Level</th>
                            <?php elseif(session()->get('level') == 1): ?>
                            <th>Bidang</th>
                            <?php endif ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($users as $user) : ?>
                        <?php if (session()->get('level') == 2 || $user['level'] != 2) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['no_hp']; ?></td>
                            <?php if(session()->get('level') == 2): ?>
                            <td>
                                <?php ?>
                                <?php $instansiId = $user['instansi_id']; ?>
                                <?php if (isset($dinas[$instansiId]['name'])) : ?>
                                <?=  $dinas[$instansiId]['name'] . '<br>'; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($user['level']==1) : ?>
                                <p> Admin</p>
                                <?php elseif ($user['level']==2) : ?>
                                <button disabled class="btn btn-outline-dark">Super Admin</button>
                                <?php endif; ?>
                            </td>
                            <?php elseif(session()->get('level') == 1 ): ?>
                            <td>
                                <?php
                                    $bidangNames = [];
                                    foreach ($bidangs as $bidangId => $bidang) {
                                        if ($bidangId == $user['bidang_id'] && $user['bidang_id'] !== null) {
                                            $bidangNames[] = $bidang['name'];
                                        }
                                    }
                                    echo implode(', ', $bidangNames);     
                                ?>
                            </td>
                            <?php endif ?>
                            <td>
                                <div class="btn-group ">
                                    <!-- update -->
                                    <a class="btnr"
                                        href="<?php echo base_url('admin/users/edit/') ?><?= $user['slug']; ?>">
                                        <button type="button" class="btn btn-block btn-warning ">
                                            <i class=" fas fa-pen"></i>
                                        </button>
                                    </a>

                                    <form id="deleteForm" class="pr-3"
                                        action="<?php echo base_url('admin/users/delete/') ?><?= $user['slug']; ?>"
                                        method="POST">
                                        <?= csrf_field(); ?>
                                        <button type="button" onclick="confirmDelete('<?= $user['slug']; ?>')"
                                            class="btn btn-block btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

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


<?php if (session()->getFlashdata('error')) : ?>
Swal.fire({
    title: 'Gagal',
    text: '<?= session()->getFlashdata('error') ?>',
    icon: 'warning',
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
document.getElementById('searchButton').addEventListener('click', performSearch);
document.getElementById('searchInput').addEventListener('input', performSearch);
</script>
<?= $this->endSection('content'); ?>