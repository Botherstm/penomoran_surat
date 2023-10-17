<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-bottom: 40px; padding-top: 30px;">
        <div class="container-fluid">
            <div class="col">
                <div class="card" style="width: 100%; height: 100%; background: #048c7f; border-radius: 27px; margin: 0 auto; ">
                    <div class="card-header border-0" style="color: white;">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-file mr-1"></i>
                            Generate Surat
                        </h3>
                    </div>
                    <div style="margin: 0 auto; padding-bottom: 20px; ">
                        <i style="font-size: 5em; color: white;" class="fas fa-file-pdf"></i>
                    </div>
                    <div style="margin: 0 auto; padding-bottom: 20px; width: 75%;">
                        <div class="preview-container" style="display: inline;">
                            <!-- Preview of the uploaded PDF will be displayed here -->
                        </div>
                    </div>
                    <!-- <div class="form-container" style="display: none; padding: 10%; color: white;"> -->
                    <div class="form-container" style=" padding: 10%; color: white;">
                        <!-- Your form code goes here -->
                        <form action="<?php echo base_url('generate/save') ?>" method="post" enctype="multipart/form-data" id="generateForm" class="text-center">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" required name="pdf_upload" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept=".pdf">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomorSurat">Dinas</label>
                                <input type="text" value="<?= $dinas['name']; ?>" class="form-control" name="instansi" id="dinas" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nomorSurat">Bidang</label>
                                <input type="text" value="<?= $bidang['name']; ?>" class="form-control" name="bidang" id="bidang" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggalSurat">Tanggal Surat</label>
                                <input type="datetime-local" name="tanggal" class="form-control" id="tanggalSurat"
                                    min="<?= date('Y-m-d\TH:i'); ?>" required>
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
<<<<<<< HEAD
                            <div class="form-group">
                                <label for="tanggalSurat">Tanggal Surat</label>
                                <input type="datetime-local" name="tanggal" class="form-control" id="tanggalSurat" min="<?= date('Y-m-d\TH:i'); ?>" required>
                            </div>
=======

>>>>>>> ecdd5f2506dd1e2c5ac8ebc437f966e03f1451f8
                            <div class="form-group mb-3">
                                <button class="btn btn-success" type="button" id="generateButton" onclick="confirmGenerate()">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script>
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
    document.getElementById("inputGroupFile01").addEventListener("change", function() {
        var fileName = this.files[0].name;
        var label = document.querySelector(".custom-file-label");
        label.textContent = fileName;
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    document.getElementById("inputGroupFile01").addEventListener("change", function(event) {
        const fileInput = event.target;
        const previewContainer = document.querySelector(".preview-container");
        const formContainer = document.querySelector(".form-container");

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // Check if the file is a PDF (you can add more validation if needed)
            if (file.type === "application/pdf") {
                // Display the uploaded PDF in the preview container
                const pdfObject = document.createElement("object");
                pdfObject.data = URL.createObjectURL(file);
                pdfObject.type = "application/pdf";
                pdfObject.style.width = "100%";
                pdfObject.style.height = "400px"; // Adjust the height as needed
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
                // Menggunakan slug yang diterima sebagai bagian dari URL saat mengirim form
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