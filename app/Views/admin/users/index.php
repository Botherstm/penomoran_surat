<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<style>
.fixed-button {
    width: 150px;
    /* Set the fixed width you want */
    position: absolute;
    /* Use absolute positioning */
    right: 0;
    /* Adjust the right property to control the position */
    top: 10px;
    /* Adjust the top property to control the vertical position */

}
</style>

<div class="content-wrapper">
    <?php if (session('success')): ?>
    <div class="alert alert-success">
        <ul>

            <li><?=esc(session('success'))?></li>

        </ul>
        <button id="dismissError" class="btn btn-secondary">Ok</button>
    </div>
    <?php endif;?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header col">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">

                                <?php if (session()->get('level') == 2): ?>
                                <h1 class="card-title">List Users</h1>
                                <?php elseif (session()->get('level') == 1): ?>
                                <h1 class="card-title">List Users <?=$dinas['name'];?></h1>
                                <?php endif?>

                            </div>
                            <!-- <div class="col-6 d-flex justify-content-end" style="padding-bottom: 4em;">
                                <div class="fixed-button">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#generateModal">
                                        <i class=" fas fa-pen-nib"></i> Tambah User
                                    </button>
                                </div>
                            </div> -->
                            <div class="col-6 d-flex justify-content-end" style="padding-bottom: 4em;">
                                <div class="fixed-button">
                                    <a href="<?=base_url('admin/users/create');?>"> <button type="button"
                                            class="btn btn-success">
                                            <i class=" fas fa-pen-nib"></i> Tambah User
                                        </button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>username</th>
                                    <th>No.Telp</th>
                                    <?php if (session()->get('level') == 2): ?>
                                    <th>Dinas</th>
                                    <th>Level</th>
                                    <?php elseif (session()->get('level') == 1): ?>
                                    <th>Bidang</th>
                                    <?php endif?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1?>
                                <?php foreach ($users as $user): ?>
                                <?php if (session()->get('level') == 2 || $user['level'] != 2): ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$user['name'];?></td>
                                    <td><?=$user['username'];?></td>
                                    <td><?=$user['no_hp'];?></td>
                                    <?php if (session()->get('level') == 2): ?>
                                    <td>
                                        <?php if ($user['level'] == 1): ?>
                                        <?php ?>
                                        <?php $instansiId = $user['instansi_id'];?>
                                        <?php if (isset($dinas[$instansiId]['name'])): ?>
                                        <?=$dinas[$instansiId]['name'] . '<br>';?>
                                        <?php endif;?>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <?php if ($user['level'] == 1): ?>
                                        <p>Operator</p>
                                        <?php elseif ($user['level'] == 2): ?>
                                        <button disabled class="btn btn-outline-dark">Super Admin</button>
                                        <?php endif;?>
                                    </td>
                                    <?php elseif (session()->get('level') == 1): ?>

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
                                    <?php endif?>

                                    <td>
                                        <div class="btn-group d-flex mx-2" style="justify-content: space-between;">
                                            <!-- update -->
                                            <a href="<?=base_url('admin/users/edit/');?><?=$user['slug'];?>"
                                                style="padding-right: 10px;">
                                                <button type="button" class="btn btn-block btn-warning ">
                                                    <i class=" fas fa-pen"></i>
                                                </button>
                                            </a>
                                            <?php if ($user['level'] == 1): ?>
                                            <form id="resetPasswordForm" class="pr-3"
                                                action="<?php echo base_url('admin/users/resetPassword/') ?><?=$user['slug'];?>"
                                                method="POST">
                                                <?=csrf_field();?>
                                                <button type="button"
                                                    onclick="confirmUpdatePassword('<?=$user['slug'];?>')"
                                                    class="btn btn-block btn-primary">
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            </form>

                                            <form id="deleteForm" class="pr-3"
                                                action="<?php echo base_url('admin/users/delete/') ?><?=$user['slug'];?>"
                                                method="POST">
                                                <?=csrf_field();?>
                                                <button type="button" onclick="confirmDelete('<?=$user['slug'];?>')"
                                                    class="btn btn-block btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>


                                            <?php endif;?>



                                        </div>
                                    </td>
                                </tr>
                                <?php endif;?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>
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
            form.action = "<?php echo base_url('admin/users/delete/') ?>" + slug;
            form.submit();
        }
    });
}

function confirmUpdatePassword(slug) {
    Swal.fire({
        title: 'Apa Kamu yakin?',
        text: 'jika kamu mereset password user akan memasukan ulang password',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Reset Password',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Menggunakan slug yang diterima sebagai bagian dari URL saat mengirim form
            const form = document.getElementById('resetPasswordForm');
            form.action = "<?php echo base_url('admin/users/resetPassword/') ?>" + slug;
            form.submit();
        }
    });
}

// // Popup success message
// <?php if (session()->getFlashdata('success')): ?>
// Swal.fire({
//     title: 'Success',
//     text: '<?=session()->getFlashdata('success')?>',
//     icon: 'success',
//     timer: 3000,
//     showConfirmButton: false
// });
// <?php endif;?>


<?php if (session()->getFlashdata('error')): ?>
Swal.fire({
    title: 'Gagal',
    text: '<?=session()->getFlashdata('error')?>',
    icon: 'warning',
    timer: 3000,
    showConfirmButton: false
});
<?php endif;?>








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

<script>
var nameInput = document.getElementById('name');
var slugInput = document.getElementById('slug');

// Function to generate a slug from the given string
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/[^\w\-]+/g, '') // Remove non-word characters (except dashes)
        .replace(/\-\-+/g, '-') // Replace multiple dashes with a single dash
        .substring(0, 50); // Limit the slug length
}

// Add an input event listener to the name input field
nameInput.addEventListener('input', function() {
    var nameValue = nameInput.value;
    var slugValue = slugify(nameValue);
    slugInput.value = slugValue;
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dismissButton = document.getElementById("dismissError");
    const errorAlert = document.querySelector(".alert.alert-danger");

    dismissButton.addEventListener("click", function() {
        errorAlert.style.display = "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
    });
});
</script>

<?=$this->endSection('content');?>