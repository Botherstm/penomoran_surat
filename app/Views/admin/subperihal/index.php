<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>



<style>
    .fixed-button {
        width: 200px;
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

                                <h1 class="card-title">List Sub-Perihal <?= $perihal['name']; ?></h1>

                            </div>

                            <div class="col-6 d-flex justify-content-end" style="padding-bottom: 4em;">
                                <div class="fixed-button">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#generateModal">
                                        <i class="icon-jarak fas fa-pen-nib"></i> Tambah Sub-Perihal
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Sub-Perihal</th>
                                    <th>Kode Sub-Perihal</th>
                                    <th>Data Detail Sub-Perihal</th>
                                    <th>Rincian Detail</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($subperihals as $subperihal) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $subperihal['name']; ?></td>
                                        <td><?= $subperihal['kode']; ?></td>
                                        <td>
                                            <?php $detailsubPerihalCounter = 1; ?>
                                            <?php foreach ($detailsubperihals[$subperihal['id']] as $detailsubPerihal) : ?>
                                                <?= $detailsubPerihalCounter++ . '. ' . $detailsubPerihal['name'] . '<br>'; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td>
                                            <div>
                                                <!-- update -->
                                                <a href="<?php echo base_url('admin/kategori/perihal/subperihal/detailsubperihal/') ?><?= $subperihal['slug']; ?>">
                                                    <button type="button" class="btn btn-dark">
                                                        Lihat rincian detail
                                                    </button>
                                                </a>
                                            </div>
                                        </td>

                                        <td>

                                            <div class="btn-group " style="padding-left: 20px; display: flex;">
                                                <a href="<?php echo base_url('/admin/kategori/perihal/subperihal/edit/') ?><?= $subperihal['slug']; ?>">
                                                    <button type="button" class="btn btn-block btn-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                </a>

                                                <form id="deleteForm" class="mr-3 " style="padding-left: 20px;" action="<?php echo base_url('admin/subperihal/delete/') ?><?= $subperihal['slug']; ?>" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <button type="button" onclick="confirmDelete('<?= $subperihal['slug']; ?>')" class="btn btn-block btn-danger">
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

                    <div class="card-header col">
                        <div class="col-6 d-flex justify-content-start">
                            <a href="<?php echo base_url('admin/kategori/perihal/') ?><?= $kategori['slug']; ?>">
                            <button type="button" class="btn btn-warning mb-3" style="width: 150px;">
                                <i class="fas fa-arrow-left" style="padding-right: 10px;"></i>  Kembali
                            </button>
                            </a>
                        </div>
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
                form.action = "<?php echo base_url('admin/subperihal/delete/') ?>" + slug;
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


<?= $this->endSection('content'); ?>