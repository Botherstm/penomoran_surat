<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
    .copy-text:hover {
        cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16"><path d="M5.5 2A.5.5 0 0 0 5 2.5v11a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5V2.5a.5.5 0 0 0-.5-.5h-5zM6 1.5A.5.5 0 0 1 6.5 1h3a.5.5 0 0 1 .5.5V15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V1.5zM11 3a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1.5 6a.5.5 0 0 1 .5.5V10h1.5a.5.5 0 0 1 0 1H10v1.5a.5.5 0 0 1-1 0V11H7.5a.5.5 0 0 1 0-1H9V8.5a.5.5 0 0 1 .5-.5z"/><path fill-rule="evenodd" d="M8.5 0a.5.5 0 0 1 .5.5V3h1a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V4H7.5a.5.5 0 0 1 0-1H8V.5a.5.5 0 0 1 .5-.5z"/><path d="M6 4.5a.5.5 0 0 0-.5.5V6H4.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V7h1.5a.5.5 0 0 0 0-1H6V5.5a.5.5 0 0 0-.5-.5z"/></svg>'), auto;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">


            <div class="card">
                <div class="card-header col">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-start">
                            <h3 class="card-title">Riwayat Nomor Surat</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#generateModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg> Generate Nomor Surat</button>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                No</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                Kode Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Perihal Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Urutan Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Tanggal Surat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Bidang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Nama
                                                User
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Nomor
                                                Hp
                                                User</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($riwayats as $riwayat) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>
                                                    <span class="copy-text" data-clipboard-text="<?= $riwayat['nomor']; ?>" title="Klik untuk menyalin kode surat">
                                                        <?= $riwayat['nomor']; ?>
                                                    </span>
                                                </td>
                                                <td><?= $riwayat['perihal']; ?></td>
                                                <td><?= $riwayat['urutan']; ?></td>
                                                <td><?= $riwayat['tanggal']; ?></td>
                                                <td>
                                                    <?php $bidangId = $riwayat['bidang_id']; ?>
                                                    <?php if (isset($bidangs[$bidangId]['name'])) : ?>
                                                        <?= $bidangs[$bidangId]['name'] . '<br>'; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $userId = $riwayat['user_id']; ?>
                                                    <?php if (isset($users[$userId]['name'])) : ?>
                                                        <?= $users[$userId]['name'] . '<br>'; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $userId = $riwayat['user_id']; ?>
                                                    <?php if (isset($users[$userId]['no_hp'])) : ?>
                                                        <?= $users[$userId]['no_hp'] . '<br>'; ?>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Generate Nomor Surat</h3>
                        </div>
                        <div class="card-body">
                            <form class="card-body text-center" action="<?php echo base_url('generate/save') ?>" method="post" enctype="multipart/form-data" id="generateForm">
                                <div class="form-group">
                                    <label for="tanggalSurat">Tanggal Surat</label>
                                    <input type="date" name="tanggal" value="<?= $tanggalmax; ?>" max="<?= $tanggalmax; ?>" class="form-control" id="tanggalSurat" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Dinas</label>
                                    <input type="name" value="<?= $dinas['name']; ?>" class="form-control form-control-border" name="instansi" id="dinas" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Bidang</label>
                                    <input type="text" value="<?= $bidang['name']; ?>" class="form-control" name="bidang" id="bidang" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nomorSurat">Urutan Surat</label>
                                    <input type="text" value="<?= $urutanPlusOne; ?>" class="form-control" name="urutan" id="urutan" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <div class="input-group">
                                        <select class="custom-select" required name="kategori" id="kategori">
                                            <option>Pilih kategori...</option>
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
                                <div class="form-group d-flex justify-content-between">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" type="button" id="generateButton" onclick="confirmGenerate()" style="width: 100px;">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.copy-text');
    clipboard.on('success', function(e) {
        e.clearSelection();
        Swal.fire('Kode Surat Berhasil Di Salin !!');
    });
    clipboard.on('error', function(e) {
        Swal.fire('gagal meyalin kode');
    });

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


    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Success',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>


    function confirmGenerate() {
        var tanggalSurat = document.getElementById("tanggalSurat").value;
        var kategori = document.getElementById("kategori").value;
        if (tanggalSurat && kategori !== "Pilih kategori...") {
            // Jika semua data diisi, aktifkan tombol "Generate"
            document.getElementById("generateButton").removeAttribute("disabled");
            Swal.fire({
                title: 'Apa Kamu yakin?',
                text: 'Perhatikan data yang di inputkan !.',
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
        } else {
            // Jika ada data yang belum diisi, tampilkan pesan kesalahan atau tindakan lain yang sesuai
            Swal.fire('Harap isi Semua datanya');
        }

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
                        subPerihalSelect.appendChild(new Option('Pilih sub perihal...',
                            ''));
                        data.forEach(function(option) {
                            subPerihalSelect.appendChild(new Option(option.name,
                                option
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
                subPerihalGroup.classList.add(
                    'd-none'); // Menyembunyikan elemen subPerihalGroup
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
                            detailsubPerihalSelect.appendChild(new Option(option
                                .name,
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