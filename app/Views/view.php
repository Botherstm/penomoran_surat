<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Nomor Surat</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add custom CSS for animation -->
    <style>
    /* Animasi ketika tombol Generate diklik */
    @keyframes generateButtonAnimation {
        0% {
            background-color: #007bff;
        }

        100% {
            background-color: #28a745;
        }
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Generate Nomor Surat</h1>
        <form class="text-center">
            <div class="form-group">
                <label for="bidang">BIDANG</label>
                <div class="input-group">
                    <select class="custom-select" id="bidang">
                        <option selected>Pilih bidang...</option>
                        <option value="kategori1">Kategori 1</option>
                        <option value="kategori2">Kategori 2</option>
                        <option value="kategori3">Kategori 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <div class="input-group">
                    <select class="custom-select" id="kategori">
                        <option selected>Pilih kategori...</option>
                        <?php foreach ($kategoris as $kategori) : ?>
                        <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="perihalGroup">
                <label for="perihal">Perihal</label>
                <div class="input-group">
                    <select class="custom-select" id="perihal">
                        <option selected>Pilih perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="subPerihalGroup">
                <label for="subPerihal">Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" id="subPerihal">
                        <option selected>Pilih sub perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="detailsubPerihalGroup">
                <label for="detailsubPerihal">Detail Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" id="detailsubPerihal">
                        <option selected>Pilih detail sub perihal...</option>
                        <!-- Placeholder for dynamic options -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nomorSurat">Nomor Surat</label>
                <input type="text" class="form-control" id="nomorSurat" readonly>
            </div>
            <div class="form-group">
                <button class="btn btn-outline-secondary" type="button" id="generateButton">Generate</button>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- get kode kategori -->
    <script>
    // Mengambil elemen-elemen yang diperlukan dari DOM
    var kategoriSelect = document.getElementById("kategori");
    var nomorSuratInput = document.getElementById("nomorSurat");

    // Menginisialisasi objek kodeKategori dari data yang dikirimkan dari controller
    var kodeKategori = <?= json_encode($kategoris); ?>;

    // Menambahkan event listener untuk dropdown "kategori"
    kategoriSelect.addEventListener("change", function() {
        var selectedKategoriId = kategoriSelect.value;
        var selectedKategori = kodeKategori.find(kategori => kategori.id == selectedKategoriId);

        if (selectedKategori) {
            var kode = selectedKategori.kode;
            nomorSuratInput.value = kode;
        } else {
            nomorSuratInput.value = "Pilih kategori terlebih dahulu";
        }
    });
    </script>

    <!-- get data perihal -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var kategoriSelect = document.getElementById('kategori');
        var perihalSelect = document.getElementById('perihal');
        var subPerihalSelect = document.getElementById('subPerihal'); // Tambahkan ini
        var detailSubPerihalSelect = document.getElementById('detailsubPerihal'); // Tambahkan ini
        var perihalGroup = document.getElementById('perihalGroup');
        var subPerihalGroup = document.getElementById('subPerihalGroup');
        var detailSubPerihalGroup = document.getElementById('detailSubPerihalGroup'); // Tambahkan ini
        var nomorSuratInput = document.getElementById('nomorSurat');
        var detailsubPerihalSelect = document.getElementById('detailsubPerihal');
        var csrfToken = '<?= csrf_hash() ?>';

        kategoriSelect.addEventListener('change', function() {
            var selectedCategoryId = kategoriSelect.value;

            // Create an AJAX request using the fetch API
            fetch('<?= site_url('admin/perihal/get_perihal_by_category/') ?>' + selectedCategoryId, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Periksa data yang diterima dari server di konsol

                    // Clear the "perihal" select element before populating it
                    perihalSelect.innerHTML = '';
                    // Add a "Pilih perihal..." option
                    perihalSelect.appendChild(new Option('Pilih perihal...', ''));

                    // Add "Perihal" options based on the array data received
                    data.forEach(function(option) {
                        perihalSelect.appendChild(new Option(option.name, option.kode));
                    });

                    // Show the "perihal" select element
                    perihalGroup.classList.remove('d-none');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        perihalSelect.addEventListener('change', function() {
            var selectedPerihalKode = perihalSelect.value;

            if (selectedPerihalKode !== '') {
                // Set the value of "nomorSurat" input to the selected perihal kode
                nomorSuratInput.value = selectedPerihalKode;
            } else {
                // If no perihal is selected, clear the "nomorSurat" input
                nomorSuratInput.value = '';
            }
        });

        perihalSelect.addEventListener('change', function() {
            var selectedPerihalId = perihalSelect.value;

            // Create an AJAX request to get sub perihal data
            fetch('<?= site_url('admin/subperihal/get_subperihal_by_perihal/') ?>' +
                    selectedPerihalId,
                    console.log(selectedPerihalId), {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                        },
                    })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Periksa data yang diterima dari server di konsol

                    // Clear the "subPerihal" select element before populating it
                    subPerihalSelect.innerHTML = '';
                    // Add a "Pilih sub perihal..." option
                    subPerihalSelect.appendChild(new Option('Pilih sub perihal...', ''));

                    // Add "Sub Perihal" options based on the array data received
                    data.forEach(function(option) {
                        subPerihalSelect.appendChild(new Option(option.name, option.kode));
                    });

                    // Show the "subPerihal" select element
                    subPerihalGroup.classList.remove('d-none');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        subPerihalSelect.addEventListener('change', function() {
            var selectedSubPerihalId = subPerihalSelect.value;

            if (selectedSubPerihalId !== '') {
                // Set the value of "nomorSurat" input to the selected sub perihal kode
                nomorSuratInput.value = selectedSubPerihalId;
            } else {
                // If no sub perihal is selected, clear the "nomorSurat" input
                nomorSuratInput.value = '';
            }
        });
        detailsubPerihalSelect.addEventListener('change', function() {
            var selectedDetailSubPerihalId = detailsubPerihalSelect.value;

            if (selectedDetailSubPerihalId !== '') {
                // Set nilai field "Nomor Surat" dengan kode dari "Detail Sub Perihal"
                nomorSuratInput.value = selectedDetailSubPerihalId;
            } else {
                // Jika tidak ada "Detail Sub Perihal" yang dipilih, kosongkan field "Nomor Surat"
                nomorSuratInput.value = '';
            }
        });

        subPerihalSelect.addEventListener('change', function() {
            var selectedSubPerihalId = subPerihalSelect.value;
            var detailsubPerihalSelect = document.getElementById('detailsubPerihal');

            // Bersihkan drop-down "Detail Sub Perihal"
            detailsubPerihalSelect.innerHTML = '';

            if (selectedSubPerihalId !== '') {
                // Lakukan permintaan AJAX untuk mendapatkan data "Detail Sub Perihal"
                fetch('/admin/subperihal/get_detail_subperihal_by_sub_perihal/' +
                        selectedSubPerihalId, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken, // Sertakan token CSRF dalam header
                            },
                        })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Periksa data yang diterima dari server di konsol

                        // Tambahkan opsi default ke drop-down "Detail Sub Perihal"
                        detailsubPerihalSelect.appendChild(new Option('Pilih detail sub perihal...',
                            ''));

                        // Tambahkan opsi "Detail Sub Perihal" berdasarkan data yang diterima
                        data.forEach(function(option) {
                            detailsubPerihalSelect.appendChild(new Option(option.name,
                                option.kode));
                        });

                        // Tampilkan drop-down "Detail Sub Perihal"
                        detailsubPerihalGroup.classList.remove('d-none');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                // Jika tidak ada "Sub Perihal" yang dipilih, kosongkan dan sembunyikan drop-down "Detail Sub Perihal"
                detailsubPerihalSelect.classList.add('d-none');
            }
        });


    });
    </script>
</body>

</html>