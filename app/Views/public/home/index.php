<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
.copy-text:hover {
    cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16"><path d="M5.5 2A.5.5 0 0 0 5 2.5v11a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5V2.5a.5.5 0 0 0-.5-.5h-5zM6 1.5A.5.5 0 0 1 6.5 1h3a.5.5 0 0 1 .5.5V15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V1.5zM11 3a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1.5 6a.5.5 0 0 1 .5.5V10h1.5a.5.5 0 0 1 0 1H10v1.5a.5.5 0 0 1-1 0V11H7.5a.5.5 0 0 1 0-1H9V8.5a.5.5 0 0 1 .5-.5z"/><path fill-rule="evenodd" d="M8.5 0a.5.5 0 0 1 .5.5V3h1a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V4H7.5a.5.5 0 0 1 0-1H8V.5a.5.5 0 0 1 .5-.5z"/><path d="M6 4.5a.5.5 0 0 0-.5.5V6H4.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V7h1.5a.5.5 0 0 0 0-1H6V5.5a.5.5 0 0 0-.5-.5z"/></svg>'), auto;
}
</style>
<div class="container-fluid content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1"
                                    class="table table-bordered table-striped dataTable dtr-inline collapsed"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">
                                                No</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">
                                                Kode Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Perihal Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Tanggal Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Dinas</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Bidang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Engine version: activate to sort column ascending">Nama User
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1"
                                                aria-label="Engine version: activate to sort column ascending">Nomor
                                                User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($riwayats as $riwayat) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <span class="copy-text" data-clipboard-text="<?= $riwayat['nomor']; ?>"
                                                    title="Klik untuk menyalin kode surat">
                                                    <?= $riwayat['nomor']; ?>
                                                </span>
                                            </td>
                                            <td><?= $riwayat['tanggal']; ?></td>
                                            <td>
                                                <?php $userId = $riwayat['user_id']; ?>
                                                <?php if (isset($users[$userId]['name'])) : ?>
                                                <?=  $users[$userId]['name'] . '<br>'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php $userId = $riwayat['user_id']; ?>
                                                <?php if (isset($users[$userId]['no_hp'])) : ?>
                                                <?=  $users[$userId]['no_hp'] . '<br>'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php $bidangId = $riwayat['bidang_id']; ?>
                                                <?php if (isset($bidangs[$bidangId]['name'])) : ?>
                                                <?=  $bidangs[$bidangId]['name'] . '<br>'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $riwayat['urutan']; ?></td>
                                            <td>
                                                <div class="btn-group ">
                                                    <a class="btnr"
                                                        href="<?php echo base_url('admin/riwayatsurat/rinciansurat') ?>">
                                                        <button type="button" class="btn btn-block btn-primary ">
                                                            <i class=" fas fa-info"></i>
                                                        </button>
                                                    </a>
                                                    <!-- update -->

                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">No</th>
                                            <th rowspan="1" colspan="1">Kode Surat</th>
                                            <th rowspan="1" colspan="1">Perihal Surat</th>
                                            <th rowspan="1" colspan="1">Tanggal Surat</th>
                                            <th rowspan="1" colspan="1"> Dinas</th>
                                            <th rowspan="1" colspan="1"> Bidang</th>
                                            <th rowspan="1" colspan="1"> Nama User</th>
                                            <th rowspan="1" colspan="1"> Nomor User</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing
                                    1 to 2 of 20 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="example1_previous">
                                            <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                                class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="example1" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0"
                                            class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
var clipboard = new ClipboardJS('.copy-text');
clipboard.on('success', function(e) {
    e.clearSelection();
    Swal.fire('Kode Surat Berhasil Di Salin !!');
});
clipboard.on('error', function(e) {
    Swal.fire('gagal meyalin kode');
});

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
            form.action = "<?php echo base_url() ?>admin/users/delete/" + slug;
            form.submit();
        }
    });
}
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
<!-- <div class="content-wrapper">
    Content Header (Page header)
    <div class="content-header" style="padding-bottom: 40px; padding-top: 30px;">
        <div class="container-fluid">
            <div class="col">
                <div class="card"
                    style="width: 100%; height: 800%; background: #048c7f; border-radius: 27px; margin: 0 auto; ">
                    <div class="card-header border-0 d-flex justify-content-center" style="color: white;">
                        <h1 class="card-title font-weight-bold fs-1 mt-5">
                            <i class="fas fa-file mr-1"></i>
                            Generate Surat
                        </h1>
                    </div>
                    <div style="margin: 0 auto; padding-bottom: 20px; padding-top: 80px; ">
                        <i style="font-size: 9em; color: white;" class="fas fa-file-pdf"></i>
                    </div>
                    <div style="margin: 0 auto; padding-bottom: 20px; width: 75%;">
                        <div class="preview-container" style="display: inline;">
</div>
</div>
<div class="form-container d-flex justify-content-center" style="color: white;">

    <form action="<?php echo base_url('generate/save') ?>" method="post" enctype="multipart/form-data" id="generateForm"
        class="" style="width: 40rem;">
        <div class="input-group" style="padding-bottom: 80px;">
            <div class="custom-file">
                <input type="file" class="custom-file-input" required name="pdf_upload" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" accept=".pdf">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
        <div class="hidden-form form-group">
            <label style="display: none; font-weight: bold; padding-bottom: 40px; font-size: 32px; ">Isi
                Data
                Penomoran</label>
            <div class="form-group">
                <label for="nomorSurat">Dinas</label>
                <input type="text" value="<?= $dinas['name']; ?>" class="form-control" name="instansi" id="dinas"
                    readonly>
            </div>
            <div class="form-group">
                <label for="nomorSurat">Bidang</label>
                <input type="text" value="<?= $bidang['name']; ?>" class="form-control" name="bidang" id="bidang"
                    readonly>
            </div>
            <div class="form-group">
                <label for="tanggalSurat">Tanggal Surat</label>
                <input type="date" name="tanggal" class="form-control" id="tanggalSurat"
                    <?php if ($generate != null) : ?> min="<?= $generate['tanggal']; ?>" <?php endif ?> required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <div class="input-group">
                    <select class="custom-select" required name="kategori" id="kategori">
                        <option selected>Pilih kategori...</option>
                        <?php foreach ($kategories as $kategori) : ?>
                        <option value="<?= $kategori['kode'] ?>"><?= $kategori['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="perihalGroup">
                <label for="perihal">Perihal</label>
                <div class="input-group">
                    <select class="custom-select" name="perihal" id="perihal">
                        <option selected>Pilih perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="subPerihalGroup">
                <label for="subPerihal">Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" name="subperihal" id="subPerihal">
                        <option selected>Pilih sub perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="detailSubPerihalGroup">
                <label for="detailsubPerihal">Detail Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" name="detailsubperihal_id" id="detailsubPerihal">
                        <option selected>Pilih detail sub perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nomorSurat">Nomor Tercetak</label>
                <input type="text" required name="nomor" class="form-control" id="nomorSurat" readonly>
            </div>
            <div class="form-group mb-3 d-flex justify-content-center" style="padding-top: 30px; ">
                <button class="btn btn-success " type="button" id="generateButton" onclick="confirmGenerate()"
                    style="width: 250px;">Generate</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
<!--  -->
</div> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('inputGroupFile01');
    const hiddenForm = document.querySelector('.hidden-form');
    hiddenForm.style.display = 'none';
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            hiddenForm.style.display = 'block';
        } else {
            hiddenForm.style.display = 'none';
        }
    });
});

function validateForm() {
    var fileInput = document.getElementById('inputGroupFile01');

    if (fileInput.files.length === 0) {
        alert("Please select a file before submitting the form.");
        return false;
    }

    // If you have additional validation logic, you can include it here.

    return true; // Form will be submitted if everything is valid.
}

<?php if (session()->getFlashdata('success')) : ?>
Swal.fire({
    title: 'Success',
    text: '<?= session()->getFlashdata('success') ?>',
    icon: 'success',
    timer: 3000,
    showConfirmButton: false
});
<?php endif; ?>



document.getElementById("inputGroupFile01").addEventListener("change", function() {
    var fileName = this.files[0].name;
    var label = document.querySelector(".custom-file-label");
    label.textContent = fileName;
});
document.getElementById("inputGroupFile01").addEventListener("change", function(event) {
    const fileInput = event.target;
    const previewContainer = document.querySelector(".preview-container");
    const formContainer = document.querySelector(".form-container");

    // Hapus elemen preview PDF yang ada sebelum menambahkan yang baru
    while (previewContainer.firstChild) {
        previewContainer.removeChild(previewContainer.firstChild);
    }

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];

        // Check if the file is a PDF (you can add more validation if needed)
        if (file.type === "application/pdf") {
            // Display the uploaded PDF in the preview container
            const pdfObject = document.createElement("object");
            pdfObject.data = URL.createObjectURL(file);
            pdfObject.type = "application/pdf";
            pdfObject.style.width = "100%";
            pdfObject.style.height = "1000px"; // Adjust the height as needed
            previewContainer.appendChild(pdfObject);

            // Show the form
            previewContainer.style.display = "block";
            formContainer.style.display = "block";
        } else {
            alert("Please upload a PDF file.");
            fileInput.value = ""; // Clear the file input
        }
    }
});

function confirmGenerate() {

    const fileInput = document.getElementById('inputGroupFile01');
    if (fileInput.files.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'File PDF belum diunggah',
            text: 'Mohon unggah file PDF terlebih dahulu.'
        });
        return;
    }
    Swal.fire({
        title: 'Apa Kamu yakin?',
        text: 'Perhatikan data yang kamu inputkan !!.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#35DC5C',
        cancelButtonColor: '#A91C1C',
        confirmButtonText: 'Generate',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('generateForm');
            form.action = "<?php echo base_url('generate/save') ?>";
            form.submit();
        }
    });
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var kategoriSelect = document.getElementById('kategori');
    var perihalSelect = document.getElementById('perihal');
    var subPerihalSelect = document.getElementById('subPerihal');
    var detailsubPerihalSelect = document.getElementById('detailsubPerihal');
    var perihalGroup = document.getElementById('perihalGroup');
    var subPerihalGroup = document.getElementById('subPerihalGroup');
    var detailSubPerihalGroup = document.getElementById('detailSubPerihalGroup');
    var nomorSuratInput = document.getElementById('nomorSurat');
    var csrfToken = '<?= csrf_hash() ?>'; // Dapatkan token CSRF

    kategoriSelect.addEventListener('change', function() {
        var selectedKategoriValue = kategoriSelect.value;

        if (selectedKategoriValue !== '') {
            // Set nilai input "Nomor Surat" dengan nilai kategori yang dipilih
            nomorSuratInput.value = selectedKategoriValue;

            // Buat permintaan AJAX untuk mengambil data "Perihal" berdasarkan kategori yang dipilih
            fetch('<?= site_url('get_perihal_by_category/') ?>' + selectedKategoriValue, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    // Bersihkan elemen "perihal" select sebelum mengisinya
                    perihalSelect.innerHTML = '';
                    // Tambahkan opsi default "Pilih perihal..."
                    perihalSelect.appendChild(new Option('Pilih perihal...', ''));

                    // Tambahkan opsi "Perihal" berdasarkan data yang diterima
                    data.forEach(function(option) {
                        perihalSelect.appendChild(new Option(option.name, option
                            .kode));
                    });

                    // Sembunyikan atau tampilkan elemen "perihal" select
                    if (data.length > 0) {
                        perihalGroup.classList.remove('d-none');
                    } else {
                        perihalGroup.classList.add('d-none');
                    }

                    // Kosongkan elemen "subPerihal" select dan nomorSuratInput
                    subPerihalSelect.innerHTML = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            // Jika tidak ada kategori yang dipilih, kosongkan input "Nomor Surat"
            nomorSuratInput.value = '';
        }
    });


    perihalSelect.addEventListener('change', function() {
        var selectedPerihalId = perihalSelect.value;

        // Implementasikan AJAX untuk mengisi data sub perihal berdasarkan perihal yang dipilih
        if (selectedPerihalId !== '') {
            fetch('get_subperihal_by_perihal/' + selectedPerihalId, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    subPerihalSelect.innerHTML = '';
                    subPerihalSelect.appendChild(new Option('Pilih sub perihal...', ''));
                    data.forEach(function(option) {
                        subPerihalSelect.appendChild(new Option(option.name, option
                            .kode));
                    });

                    subPerihalGroup.classList.remove(
                        'd-none'); // Menampilkan elemen subPerihalGroup
                    detailSubPerihalGroup.classList.add(
                        'd-none'); // Menyembunyikan elemen detailSubPerihalGroup
                    nomorSuratInput.value =
                        selectedPerihalId; // Mengisi nomor surat dengan kode perihal yang dipilih
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        } else {
            subPerihalGroup.classList.add('d-none'); // Menyembunyikan elemen subPerihalGroup
            detailSubPerihalGroup.classList.add(
                'd-none'); // Menyembunyikan elemen detailSubPerihalGroup
            nomorSuratInput.value = ''; // Menghapus nilai dari nomorSuratInput
        }
    });

    subPerihalSelect.addEventListener('change', function() {
        var selectedSubPerihalId = subPerihalSelect.value;

        // Implementasikan AJAX untuk mengisi data detail sub perihal berdasarkan sub perihal yang dipilih
        if (selectedSubPerihalId !== '') {
            fetch('get_detailsubperihal_by_subperihal/' + selectedSubPerihalId, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    detailsubPerihalSelect.innerHTML = '';
                    detailsubPerihalSelect.appendChild(new Option(
                        'Pilih detail sub perihal...',
                        ''));
                    data.forEach(function(option) {
                        detailsubPerihalSelect.appendChild(new Option(option.name,
                            option.kode));
                    });
                    detailSubPerihalGroup.classList.remove('d-none');
                    nomorSuratInput.value =
                        selectedSubPerihalId; // Mengisi nomor surat dengan kode detail sub perihal yang dipilih
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            detailSubPerihalGroup.classList.add('d-none');
            nomorSuratInput.value = '';
        }
    })
});

document.addEventListener('DOMContentLoaded', function() {
    // Dapatkan elemen nomorSurat setelah halaman selesai dimuat
    var nomorSuratInput = document.getElementById('nomorSurat');

    var detailsubPerihalSelect = document.getElementById('detailsubPerihal');

    detailsubPerihalSelect.addEventListener('change', function() {
        var selectedDetailSubPerihal = detailsubPerihalSelect.value;

        if (selectedDetailSubPerihal !== '') {
            // Set nilai input "Nomor Surat" dengan kode detail sub perihal yang dipilih
            nomorSuratInput.value = selectedDetailSubPerihal;
        } else {
            // Jika tidak ada detail sub perihal yang dipilih, kosongkan input "Nomor Surat"
            nomorSuratInput.value = '';
        }
    });
});
</script>


<?= $this->endSection('content'); ?>