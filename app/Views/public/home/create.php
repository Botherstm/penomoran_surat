<?=$this->extend('public/layouts/main');?>

<?=$this->section('content');?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                    <li><?=esc($error)?></li>
                    <?php endforeach;?>
                </ul>
                <button id="dismissError" class="btn btn-dark" style="width: 10%;">Hide</button>
            </div>
            <?php endif;?>
            <!-- Main content -->
            <!-- <div class="row jarak ">
                    <div class="card-tools">
                        <div class="btnadd">
                        </div>
                    </div>
                    <div class="card-tools">
                    </div>
                </div> -->

            <div class="card card-success">


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Generate Nomor Surat</h3>
                </div>
                <div class="card-body">
                    <form class="card-body " action="<? base_url('generate/save') ?>" method="post"
                        enctype="multipart/form-data" id="generateForm">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Surat</label>
                            <input type="date" name="tanggal" max="<?=$tanggalmax;?>" class="form-control" id="tanggal"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nomorSurat">Dinas</label>
                            <input type="name" value="<?=$dinas['name'];?>" class="form-control form-control-border"
                                name="instansi" id="dinas" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nomorSurat">Bidang</label>
                            <input type="text" value="<?=$bidang['name'];?>" class="form-control" name="bidang"
                                id="bidang" readonly>
                        </div>
                        <div class="form-group">
                            <label for="urutan">Urutan Surat</label>
                            <input type="text" class="form-control" value="<?=$urutan;?>" name="urutan" id="urutan"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <div class="input-group">
                                <select class="custom-select" required name="kategori" id="kategori">
                                    <option>Pilih kategori...</option>
                                    <?php foreach ($kategories as $kategori): ?>
                                    <option value="<?=$kategori['kode']?>"><?=$kategori['name']?></option>
                                    <?php endforeach;?>
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
                            <a href="<?=base_url('/');?>"><button class="btn btn-danger" type="button"
                                    style="width: 150px;" data-dismiss="modal">Batal</button></a>
                            <button class="btn btn-success" type="button" id="generateButton"
                                onclick="confirmGenerate()" style="width: 150px;">Generate</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script src="https: //cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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


<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    title: 'Success',
    text: '<?=session()->getFlashdata('success')?>',
    icon: 'success',
    timer: 3000,
    showConfirmButton: false
});
<?php endif;?>


function confirmGenerate() {
    var tanggal = document.getElementById("tanggal").value;
    var kategori = document.getElementById("kategori").value;
    if (tanggal && kategori !== "Pilih kategori...") {
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
    var csrfToken = '<?=csrf_hash()?>'; // Dapatkan token CSRF

    kategoriSelect.addEventListener('change', function() {
        var selectedKategoriValue = kategoriSelect.value;

        if (selectedKategoriValue !== '') {
            // Set nilai input "Nomor Surat" dengan nilai kategori yang dipilih
            nomorSuratInput.value = selectedKategoriValue;

            // Buat permintaan AJAX untuk mengambil data "Perihal" berdasarkan kategori yang dipilih
            fetch('<?=site_url('get_perihal_by_category/')?>' + selectedKategoriValue, {
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dapatkan elemen "urutan" dan "tanggalSurat" setelah halaman selesai dimuat
    var urutan = document.getElementById('urutan');
    var tanggalSuratInput = document.getElementById('tanggal');

    tanggalSuratInput.addEventListener('change', function() {
        var selectedDate = tanggalSuratInput.value; // Dapatkan tanggal yang dipilih

        if (selectedDate) {
            // Lakukan permintaan AJAX untuk mengambil data urutan berdasarkan tanggal yang dipilih
            fetch('/generate/data/' + selectedDate)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Di sini, Anda dapat memproses data yang diterima sesuai kebutuhan
                    console.log('Data urutan yang diterima:', data[0].urutanSebelumnya);

                    // Misalnya, Anda dapat mengisinya ke elemen "urutan" seperti ini:
                    urutan.value = data[0].urutanSebelumnya;

                })

        }
    });
});
</script>


<?=$this->endSection('content');?>