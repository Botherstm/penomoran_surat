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

    /* Gaya untuk kontainer utama */
    .container {
        max-width: 300px;
        /* Atur lebar maksimum sesuai keinginan Anda */
        margin: 0 auto;
        /* Pusatkan kontainer di tengah halaman */
    }

    /* Gaya untuk label */
    label {
        font-weight: bold;
        /* Tambahkan ketebalan huruf untuk label */
    }

    /* Gaya untuk tombol Generate */
    #generateButton {
        margin-top: 10px;
        /* Beri jarak atas antara tombol dan elemen di atasnya */
        animation: generateButtonAnimation 0.3s ease-in-out;
        /* Animasikan tombol ketika diklik */
    }

    /* Gaya untuk nomor surat input */
    #nomorSurat {
        font-weight: bold;
        /* Tambahkan ketebalan huruf untuk nomor surat */
        background-color: #f8f9fa;
        /* Atur latar belakang menjadi abu-abu muda */
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
                        <?php foreach ($kategories as $kategori) : ?>
                        <option value="<?= $kategori['kode'] ?>"><?= $kategori['name'] ?></option>
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
            <div class="form-group d-none" id="detailSubPerihalGroup">
                <label for="detailSubPerihal">Detail Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" id="detailSubPerihal">
                        <!-- Perubahan ID di sini -->
                        <option selected>Pilih detail sub perihal...</option>
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

    <!-- JavaScript untuk mengambil data -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var kategoriSelect = document.getElementById('kategori');
        var perihalSelect = document.getElementById('perihal');
        var subPerihalSelect = document.getElementById('subPerihal');
        var perihalGroup = document.getElementById('perihalGroup');
        var subPerihalGroup = document.getElementById('subPerihalGroup');
        var detailSubPerihalSelect = document.getElementById('detailSubPerihal');
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
                            perihalSelect.appendChild(new Option(option.name, option.kode));
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
            var selectedPerihalKode = perihalSelect.value;

            if (selectedPerihalKode !== '') {
                // Set nilai input "Nomor Surat" dengan kode perihal yang dipilih
                nomorSuratInput.value = selectedPerihalKode;
            } else {
                // Jika tidak ada perihal yang dipilih, kosongkan input "Nomor Surat"
                nomorSuratInput.value = '';
            }
        });

        perihalSelect.addEventListener('change', function() {
            var selectedPerihalKode = perihalSelect.value;

            if (selectedPerihalKode !== '') {
                // Buat permintaan AJAX untuk mengambil data "Sub Perihal" berdasarkan "Perihal" yang dipilih
                fetch('<?= site_url('get_subperihal_by_perihal/') ?>' +
                        selectedPerihalKode, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        // Bersihkan elemen "subPerihal" select sebelum mengisinya
                        subPerihalSelect.innerHTML = '';
                        // Tambahkan opsi default "Pilih sub perihal..."
                        subPerihalSelect.appendChild(new Option('Pilih sub perihal...', ''));

                        // Tambahkan opsi "Sub Perihal" berdasarkan data yang diterima
                        data.forEach(function(option) {
                            subPerihalSelect.appendChild(new Option(option.name, option
                                .id));
                        });

                        // Tampilkan elemen "subPerihal" select
                        subPerihalGroup.classList.remove('d-none');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                // Jika tidak ada "Perihal" yang dipilih, sembunyikan elemen "subPerihal" select
                subPerihalSelect.innerHTML = '';
                subPerihalGroup.classList.add('d-none');
            }
        });
    });

    subPerihalSelect.addEventListener('change', function() {
        var selectedSubPerihalId = subPerihalSelect.value;

        if (selectedSubPerihalId !== '') {
            // Set nilai input "Nomor Surat" dengan kode sub perihal yang dipilih
            nomorSuratInput.value = selectedSubPerihalId;
            // Buat permintaan AJAX untuk mengambil data "Detail Sub Perihal" berdasarkan id sub perihal yang dipilih
            fetch('<?= site_url('get_detailsubperihal_by_subperihal/') ?>' + selectedSubPerihalId, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    // Bersihkan elemen "detailSubPerihal" select sebelum mengisinya
                    detailSubPerihalSelect.innerHTML = '';
                    // Tambahkan opsi default "Pilih detail sub perihal..."
                    detailSubPerihalSelect.appendChild(new Option('Pilih detail sub perihal...', ''));

                    // Tambahkan opsi "Detail Sub Perihal" berdasarkan data yang diterima
                    data.forEach(function(option) {
                        detailSubPerihalSelect.appendChild(new Option(option.name, option.id));
                    });

                    // Tampilkan elemen "detailSubPerihal" select
                    detailSubPerihalGroup.classList.remove('d-none');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            // Jika tidak ada "Sub Perihal" yang dipilih, sembunyikan elemen "detailSubPerihal" select
            detailSubPerihalSelect.innerHTML = '';
            detailSubPerihalGroup.classList.add('d-none');
        }
    });
    detailSubPerihalSelect.addEventListener('change', function() {
        var selectedDetailSubPerihalId = detailSubPerihalSelect.value;

        if (selectedDetailSubPerihalId !== '') {
            // Set nilai input "Nomor Surat" dengan kode detail sub perihal yang dipilih
            nomorSuratInput.value = selectedDetailSubPerihalId;
        } else {
            // Jika tidak ada detail sub perihal yang dipilih, kosongkan input "Nomor Surat"
            nomorSuratInput.value = '';
        }
    });
    </script>
</body>

</html>