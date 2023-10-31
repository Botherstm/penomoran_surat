<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

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

                                <?php if (session()->get('level') == 2) : ?>
                                    <h1 class="card-title">List Bidang <?= $instansi['name']; ?> </h1>
                                <?php elseif (session()->get('level') == 1) : ?>
                                    <h1 class="card-title">List Bidang <?= $instansi['name']; ?></h1>
                                <?php endif ?>



                            </div>
                            <div class="col-6 d-flex justify-content-end" style="padding-bottom: 4em;">
                                <div class="fixed-button">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#generateModal">
                                        <i class=" fas fa-pen-nib"></i> Tambah Bidang
                                    </button>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Bidang</th>
                                    <th>Kode Bidang</th>
                                    <?php if (session()->get('level') == 2) : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($bidangs as $bidang) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $bidang['name']; ?></td>
                                        <td><?= $bidang['kode']; ?></td>
                                        <?php if (session()->get('level') == 2) : ?>
                                            <td>
                                                <div class="btn-group " style="margin-left: 25%;">
                                                    <!-- update -->
                                                    <a href="<?php echo base_url('/admin/dinas/bidang/edit/') ?><?= $bidang['slug']; ?>">
                                                        <button type="button" class="btn btn-block btn-warning">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                    </a>
                                                </div>

                                                <div class="btn-group ">
                                                    <!-- update -->
                                                    <form id="deleteForm" class="ml-3" action="<?php echo base_url('admin/bidang/delete/') ?><?= $bidang['slug']; ?>" method="POST">
                                                        <?= csrf_field(); ?>
                                                        <button type="button" onclick="confirmDelete('<?= $bidang['slug']; ?>')" class="btn btn-block btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header col">
                        <div class="col-6 d-flex justify-content-start">
                            <a href="<?php echo base_url('admin/dinas') ?>">
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

<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Bidang <?= $instansi['name']; ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/bidang/save') ?>" method="POST" class="">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="bidang" class="form-label input-group justify-content-center">Nama Bidang</label>
                        <input type="text" class="form-control " name="name" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="instansi_id" name="instansi_id" value="<?= $instansi['id']; ?>" readonly>
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="mb-5 m-1 ">
                        <label for="bidang" class="form-label input-group justify-content-center">Kode Bidang</label>
                        <input type="name" class="form-control " name="kode" id="kode" aria-describedby="emailHelp">
                    </div>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <button class="btn btn-danger" style="width:80%;" type="button" data-dismiss="modal">Batal</button>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success " style="width:80%;">Tambah
                                data</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Bidang <?= $instansi['name']; ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/bidang/update/') ?><?= $bidang['id']; ?>" method="POST" class="">
                    <?= csrf_field(); ?>
                    <div class="mb-5 m-1 ">
                        <label for="bidang" class="form-label input-group justify-content-center">Nama Bidang</label>
                        <input type="text" name="name" value="<?= $bidang['name']; ?>" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden value="<?= $bidang['instansi_id']; ?>" class="form-control" id="instansi_id" name="instansi_id" readonly>
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden value="<?= $bidang['slug']; ?>" class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="mb-5 m-1">
                        <label for="kodeBidang" class="form-label input-group justify-content-center">Kode
                            Bidang</label>
                        <input type="name" name="kode" value="<?= $bidang['kode']; ?>" class="form-control" id="kodeBidang">
                    </div>

                    <div class="row text-center">

                        <div class="col-md-6 ">
                            <button class="btn btn-danger" style="width:80%;" type="button" data-dismiss="modal">Batal</button>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success " style="width: 80%;">Edit Data</button>
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
                form.action = "<?php echo base_url('admin/bidang/delete/') ?>" + slug;
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

<?= $this->endSection('content'); ?>