<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<style>
.fixed-button {
    width: 250px;
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Main content -->
            <section class="content">
                <!-- <div class="row jarak ">
                    <div class="card-tools">
                        <div class="btnadd">
                        </div>
                    </div>
                    <div class="card-tools">
                    </div>
                </div> -->
                <?php if (session('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                        <li><?=esc($error)?></li>
                        <?php endforeach;?>
                    </ul>
                    <button id="dismissError" class="btn btn-primary">Ok</button>
                </div>
                <?php endif;?>
                <div class="card">
                    <div class="card-header col">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">

                                <h1 class="card-title">List Detail Sub-Perihal <?=$subperihal['name'];?></h1>

                            </div>

                            <div class="col-6 d-flex justify-content-end" style="padding-bottom: 4em; ">
                                <div class="fixed-button">
                                    <a
                                        href="<?php echo base_url('admin/kategori/perihal/subperihal/detailsubperihal/create/') ?><?=$subperihal['slug'];?>">
                                        <button type="button" class="btn btn-success">
                                            <i class=" fas fa-pen-nib"></i> Tambah Detail Sub-Perihal
                                        </button>
                                    </a>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Detail</th>
                                    <th>Kode Detail</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1?>
                                <?php foreach ($detailsubperihals as $detailsubperihal): ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$detailsubperihal['name'];?></td>
                                    <td><?=$detailsubperihal['kode'];?></td>
                                    <td>
                                        <div class="btn-group " style="padding-left:80px;">
                                            <a
                                                href="<?php echo base_url('admin/kategori/perihal/subperihal/detailsubperihal/edit/') ?><?=$detailsubperihal['slug'];?>">
                                                <button type="button" class="btn btn-block btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            </a>
                                            <form id="deleteForm" class="mr-3 " style="padding-left: 20px;"
                                                action="<?php echo base_url('admin/detailsubperihal/delete/') ?><?=$detailsubperihal['slug'];?>"
                                                method="POST">
                                                <?=csrf_field();?>
                                                <button type="button"
                                                    onclick="confirmDelete('<?=$detailsubperihal['slug'];?>')"
                                                    class="btn btn-block btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header col">
                        <div class="col-6 d-flex justify-content-start">
                            <a
                                href="<?php echo base_url('admin/kategori/perihal/subperihal/') ?><?=$perihal['slug'];?>">
                                <button type="button" class="btn btn-warning mb-3" style="width: 150px;">
                                    <i class="fas fa-arrow-left" style="padding-right: 10px;"></i> Kembali
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Detail Sub-Perihal <?=$subperihal['name'];?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/detailsubperihal/save') ?>" method="POST" class="">
                    <?=csrf_field();?>

                    <div class="mb-5 m-1 ">
                        <label for="detail" class="form-label input-group justify-content-center">Detail</label>
                        <input type="text" name="name" required class="form-control  " id="name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="detail_id" name="detail_id"
                            value="<?=$subperihal['id'];?>" readonly>
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="mb-5 m-1">
                        <label for="kodeDetail" class="form-label input-group justify-content-center">Kode
                            Detail</label>
                        <input type="name" name="kode" required class="form-control" id="kodeDetail">
                    </div>

                    <div class="row text-center">

                        <div class="col-md-6 ">
                            <button class="btn btn-danger" style="width:80%;" type="button"
                                data-dismiss="modal">Batal</button>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success " style="width: 80%;">Tambah Data</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const dismissButton = document.getElementById("dismissError");
    const errorAlert = document.querySelector(".alert.alert-danger");

    dismissButton.addEventListener("click", function() {
        errorAlert.style.display = "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
    });
});
</script>

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
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Menggunakan slug yang diterima sebagai bagian dari URL saat mengirim form
            const form = document.getElementById('deleteForm');
            form.action = "<?php echo base_url('admin/detailsubperihal/delete/') ?>" + slug;
            form.submit();
        }
    });
}

// Popup success message
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    title: 'Success',
    text: '<?=session()->getFlashdata('success')?>',
    icon: 'success',
    timer: 3000,
    showConfirmButton: false
});
<?php endif;?>



function performSearch() {

    var searchText = document.getElementById('searchInput').value.toLowerCase();

    var tableRows = document.querySelectorAll('.table tbody tr');

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

<?=$this->endSection('content');?>