<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<style>
    .form-group {
        margin-top: 30px;
    }
</style>

<div class="content-wrapper">
    <!-- ... Bagian lainnya ... -->

    <div class="form-container" style="padding: 1% 10%;">
        <!-- Your form code goes here -->
        <form action="<?php echo base_url('generate/save') ?>" method="post" enctype="multipart/form-data" id="generateForm" class="text-center">
            <div class="form-group" style="margin-bottom: 50px;">
                <label for="tanggalSurat">Cari Tanggal Surat</label>
                <input type="datetime-local" name="tanggal" class="form-control" id="tanggalSurat" min="<?= date('Y-m-d\TH:i'); ?>" required>
            </div>

            <div class="input-group d-none" id="chooseFile">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" required name="pdf_upload" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept=".pdf">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="form-group d-none" id="dinas">
                <label for="nomorSurat">Dinas</label>
                <input type="text" value="<?= $dinas['name']; ?>" class="form-control" name="instansi" id="dinas" readonly>
            </div>
            <div class="form-group d-none" id="bidang">
                <label for="nomorSurat">Bidang</label>
                <input type="text" value="<?= $bidang['name']; ?>" class="form-control" name="bidang" id="bidang" readonly>
            </div>

            <div class="form-group d-none" id="perihalGroup">
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
            <div class="form-group d-none" id="subPerihalGroup">
                <label for="perihal">Perihal</label>
                <div class="input-group">
                    <select class="custom-select" name="perihal" id="perihal">
                        <option selected>Pilih perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="detailSubPerihalGroup">
                <label for="subPerihal">Sub Perihal</label>
                <div class="input-group">
                    <select class="custom-select" name="subperihal" id="subPerihal">
                        <option selected>Pilih sub perihal...</option>
                    </select>
                </div>
            </div>
            <div class="form-group d-none" id="nomorTercetak">
                <label for="nomorSurat">Nomor Tercetak</label>
                <input type="text" required name="nomor" class="form-control" id="nomorSurat" readonly>
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-success" type="button" id="generateButton" onclick="confirmGenerate()">Generate</button>
            </div>
        </form>
    </div>
</div>


<!-- khusus untuk surat TERLEWAT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tanggalSuratInput = document.getElementById('tanggalSurat');
        var chooseFile = document.getElementById('chooseFile');
        var dinas = document.getElementById('dinas');
        var bidang = document.getElementById('bidang');
        var perihalGroup = document.getElementById('perihalGroup');
        var subPerihalGroup = document.getElementById('subPerihalGroup');
        var detailSubPerihalGroup = document.getElementById('detailSubPerihalGroup');
        var nomorTercetak = document.getElementById('nomorTercetak');

        tanggalSuratInput.addEventListener('change', function() {
            if (tanggalSuratInput.value !== '') {
                // Tanggal dipilih, tampilkan elemen kategori
                perihalGroup.classList.remove('d-none');
                chooseFile.classList.remove('d-none');
                dinas.classList.remove('d-none');
                bidang.classList.remove('d-none');
                nomorTercetak.classList.remove('d-none');
            } else {
                // Tanggal tidak dipilih, sembunyikan elemen kategori dan seterusnya
                perihalGroup.classList.add('d-none');
                subPerihalGroup.classList.add('d-none');
                detailSubPerihalGroup.classList.add('d-none');
                nomorTercetak.classList.add('d-none');
            }
        });
    });
</script>




<?= $this->endSection('content'); ?>