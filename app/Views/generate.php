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
        <div class="text-center">
            <h3>selamat datang <?= session()->get('name'); ?> </h3>
            <?php if( session()->get('level') == 2): ?>
            <a href="<?php echo base_url() ?>admin" target="_blank">
                <button class="btn btn-outline-dark">Super Admin</button>
            </a>
            <?php elseif(session()->get('level') == 1): ?>
            <a href="<?php echo base_url() ?>admin" target="_blank">
                <button class="btn btn-outline-dark">Admin</button>
            </a>
            <?php else: ?>
            <?php endif; ?>
            <a href="<?php echo base_url() ?>logout">
                <button class="btn btn-outline-danger">log out !</button>
            </a>
        </div>
        <form class="text-center">
            <h1 class="text-center f">Generate Nomor Surat </h1>
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
                <label for="detailsubPerihal">Detail Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" id="detailsubPerihal">
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
</body>

</html>