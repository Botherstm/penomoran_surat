<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

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
                    <h1 class=" font-weight-bold ">List Dinas</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="btnadd">
        <a href="#">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#generateModal">
                <i class="icon-jarak fas fa-plus"></i>
                Tambah
            </button>
        </a>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row jarak ">

            <div class="card">


                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>No.</th>
                                <th>Nama Dinas</th>
                                <th>Aksi Urutan Surat</th>
                                <th>Data Bidang</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1?>
                            <?php foreach ($dinass as $dinas): ?>
                            <tr class="text-center">
                                <td><?=$i++;?></td>
                                <td><?=$dinas['name']?></td>

                                <td>
                                    <?php if (!empty($urutans[$dinas['id']])): ?>
                                    <?php foreach ($urutans[$dinas['id']] as $urutan): ?>
                                    <?=$urutan['urutan'] . '<br>';?>
                                    <?php endforeach;?>
                                    <!-- Jika data urutan sudah ada, tampilkan tombol "Edit" -->
                                    <a
                                        href="<?php echo base_url('admin/dinas/urutansurat/edit/') ?><?=$dinas['slug'];?>">
                                        <button type="button" class="btn btn-primary">Edit</button>
                                    </a>
                                    <?php else: ?>
                                    <!-- Jika data urutan belum ada, tampilkan tombol "Tambah Data" -->
                                    <a
                                        href="<?php echo base_url('admin/dinas/urutansurat/create/') ?><?=$dinas['slug'];?>">
                                        <button type="button" class="btn btn-success">Tambah Data</button>
                                    </a>
                                    <?php endif;?>
                                </td>

                                <td>
                                    <!-- data bidang -->
                                    <div>
                                        <a href="<?php echo base_url('admin/dinas/bidang/') ?><?=$dinas['slug']?>">
                                            <button type="button" class="btn btn-dark">
                                                Lihat Bidang
                                            </button>
                                        </a>
                                    </div>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <!-- update -->
                                        <a class="btnr"
                                            href="<?php echo base_url('admin/dinas/edit/') ?><?=$dinas['slug'];?>">
                                            <button type="button" class="btn btn-block btn-warning ">
                                                <i class=" fas fa-pen"></i>
                                            </button>
                                        </a>
                                        <form id="deleteForm" class="mr-3"
                                            action="<?php echo base_url('admin/dinas/delete/') ?><?=$dinas['slug'];?>"
                                            method="POST">
                                            <?=csrf_field();?>
                                            <button type="button" onclick="confirmDelete('<?=$dinas['slug'];?>')"
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


                    <div class="modal fade" id="generateModal" tabindex="-1" role="dialog"
                        aria-labelledby="generateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data Dinas</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo base_url('admin/dinas/save') ?>" method="POST" class="">
                                        <?=csrf_field();?>
                                        <div class="form-group ">
                                            <label for="kategori"
                                                class="form-label input-group justify-content-center">Nama Dinas</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="name" hidden class="form-control" id="slug" name="slug"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="kodeKategori"
                                                class="form-label input-group justify-content-center">Kode Dinas</label>
                                            <input type="name" name="kode" class="form-control " id="kodeKategori">
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <a href="<?php echo base_url('admin/dinas') ?>">
                                                    <button type="button" class="btn btn-danger"
                                                        style="width: 80%;">Batal</button>
                                                </a>
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



                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
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
                                form.action = "<?php echo base_url() ?>admin/dinas/delete/" + slug;
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

                    <?=$this->endSection('content');?>