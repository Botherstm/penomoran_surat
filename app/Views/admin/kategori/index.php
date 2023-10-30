"<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>


<style>
    .fixed-button {
        width: 200px; /* Set the fixed width you want */
        position: absolute; /* Use absolute positioning */
        right: 0; /* Adjust the right property to control the position */
        top: 10px; /* Adjust the top property to control the vertical position */
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

                <div class="card">
                    <div class="card-header col">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">
                                <h1 class="card-title">List Kategori</h1>
                            </div>
                            
                            <div class="col-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-success mb-3" data-toggle="modal"
                                    data-target="#generateModal"><i class="icon-jarak fas fa-pen-nib"></i>
                                    Tambah Kategori</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped ">
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
                                <?php $i = 1?>
                                <?php foreach ($kategoris as $kategori): ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$kategori['name'];?></td>
                                    <td><?=$kategori['kode'];?></td>
                                    <td>
                                        <?php $PerihalCounter = 1;?>
                                        <?php foreach ($perihals[$kategori['id']] as $perihal): ?>
                                        <?=$PerihalCounter++ . '. ' . $perihal['name'] . '<br>';?>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <div>
                                            <a
                                                href="<?php echo base_url('admin/kategori/perihal/') ?><?=$kategori['slug'];?>">
                                                <button type="button" class="btn btn-dark">
                                                    Lihat rincian perihal
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group " style="display: flex;">
                                            <button type="button" class="btn btn-block btn-warning"
                                                onclick="openEditModal('<?=$kategori['id']?>', '<?=$kategori['name']?>', '<?=$kategori['kode']?>', '<?=$kategori['slug']?>')">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <form style="padding-left: 10px;" id="deleteForm"
                                                action="<?php echo base_url('admin/kategori/delete/') ?><?=$kategori['slug'];?>"
                                                method="POST">
                                                <?=csrf_field();?>
                                                <button type="button" data-target="editmodal"
                                                    onclick="confirmDelete('<?=$kategori['slug'];?>')"
                                                    class="btn btn-block btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
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
                <h3 class="card-title">Tambah Data Kategori</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/kategori/save') ?>" method="POST" class="">
                    <?=csrf_field();?>
                    <div class="mb-5 m-1 ">
                        <label for="kategori" class="form-label input-group justify-content-center">Kategori</label>
                        <input type="text" class="form-control " name="name" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="mb-5 m-1">
                        <label for="kodeKategori" class="form-label input-group justify-content-center">Kode
                            Kategori</label>
                        <input type="name" name="kode" class="form-control " id="kodeKategori">
                    </div>

                    <div class="row text-center">

                        <div class="col-md-6">
                            <button class="btn btn-danger" style="width:80%;" type="button"
                                data-dismiss="modal">Batal</button>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success " style="width: 80%;">Tambah data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Kategori</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="editForm">
                    <?=csrf_field();?>

                    <div class="mb-5 m-1">
                        <label for="name" class="form-label input-group justify-content-center">Kategori</label>
                        <input type="text" name="name" class="form-control" id="editName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-5 m-1">
                        <label for="kodeKategori" class="form-label input-group justify-content-center">Kode
                            Kategori</label>
                        <input type="text" name="kode" class="form-control" id="editKodeKategori">
                    </div>

                    <!-- Input untuk menyimpan slug -->
                    <input type="" name="slug" id="editSlug">

                    <div class="row text-center">
                        <div class="col-md-6">
                            <button class="btn btn-danger" style="width: 80%;" type="button"
                                data-dismiss="modal">Batal</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success" style="width: 80%;">Edit Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script>
// function showAlert() {
//     Swal.fire('Ini adalah pesan SweetAlert2!');
// }
function openEditModal(id, name, kode, slug) {
    // Mengisi nilai-nilai input di dalam form edit sesuai dengan data kategori yang akan diedit
    document.getElementById('editName').value = name;
    document.getElementById('editKodeKategori').value = kode;
    document.getElementById('editSlug').value = slug;

    // Mengatur URL form action dengan ID kategori
    var form = document.querySelector('#editForm');
    form.action = `<?php echo base_url('admin/kategori/update/') ?>${id}`;

    // Aktifkan form pop-up
    $('#editModal').modal('show');
}

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
            form.action = "<?php echo base_url('admin/kategori/delete/') ?>" + slug;
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

<?=$this->endSection('content');?>"