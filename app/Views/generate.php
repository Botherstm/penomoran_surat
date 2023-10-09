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
        var nomorSuratInput = document.getElementById('nomorSurat');
        var csrfToken = '<?= csrf_hash() ?>'; // Dapatkan token CSRF

        kategoriSelect.addEventListener('change', function() {
            var selectedCategoryId = kategoriSelect.value;

            // Buat permintaan AJAX untuk mengambil data "Perihal" berdasarkan kategori yang dipilih
            fetch('<?= site_url('get_perihal_by_category/') ?>' + selectedCategoryId, {
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
                    nomorSuratInput.value = '';
                    // Sembunyikan elemen "subPerihal" select
                    subPerihalGroup.classList.add('d-none');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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

        subPerihalSelect.addEventListener('change', function() {
            var selectedSubPerihalId = subPerihalSelect.value;

            if (selectedSubPerihalId !== '') {
                // Buat permintaan AJAX untuk mengambil data "Sub Perihal" berdasarkan sub perihal yang dipilih
                fetch('<?= site_url('admin/subperihal/get_subperihal_by_perihal/') ?>' +
                        selectedSubPerihalId, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        // Set nilai input "Nomor Surat" dengan kode sub perihal yang dipilih
                        nomorSuratInput.value = data.kode;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                // Jika tidak ada sub perihal yang dipilih, kosongkan input "Nomor Surat"
                nomorSuratInput.value = '';
            }
        });
    });
    </script>
</body>

</html>