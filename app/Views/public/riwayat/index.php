<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!--  -->
    <div>
        <section class="content">
            <div style="width: 100%; background: #048C7F; padding-top: 10px; padding-bottom: 10px; ">
                <div class="row">
                    <div class="col-md-8 offset-md-2" >
                        <form action="simple-results.html" >
                            <div class="input-group">
                                <input type="search" class="form-control "
                                    placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="container-fluid" style="padding-top: 50px; padding-bottom: 50px;">
        <section class="content">
            <div class="col" style="padding-bottom: 50px;">
                <div class="d-flex flex-row justify-content-center">
                    <div class="card-deck">
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to
                                    additional content.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This card has even longer content than the first to
                                    show that equal height action.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="card-deck">
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional
                                content.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This card has even longer content than the first to show that equal
                                height action.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

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