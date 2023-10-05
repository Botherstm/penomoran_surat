<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content'); ?>
<style>
.album-container {
    animation: fadeInUp 1s ease;
}

.album-form {
    max-width: 500px;
    margin: 0 auto;
}

.album-image-preview {
    max-width: 300px;
    margin-bottom: 20px;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<div class="album-container">

    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
            <h2 class="text-center">Create Data Perihal <?= $kategori['name']; ?></h2>
            <form class="album-form" method="POST"
                action="<?php echo base_url() ?>admin/perihal/save/<?= $kategori['slug']; ?>"
                enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if (session('error')) : ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text"
                        class="form-control <?= (isset($validation) && $validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                        id="name" name="name" autofocus>
                    <?php if (isset($validation) && $validation->hasError('name')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('name'); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <input type="text" class="form-control" id="kategori_id" value="<?= $kategori['id']; ?>"
                    name="kategori_id" hidden>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" readonly>
                </div>
                <div class="form-group">
                    <label for="kode">Kode Surat</label>
                    <input type="name"
                        class="form-control <?= (isset($validation) && $validation->hasError('kode')) ? 'is-invalid' : ''; ?>"
                        id="kode" name="kode" autofocus>
                    <?php if (isset($validation) && $validation->hasError('kode')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kode'); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Mendapatkan referensi elemen input kode surat dan slug
var kodeInput = document.getElementById('name');
var slugInput = document.getElementById('slug');

// Menambahkan event listener pada input kode surat untuk mengupdate slug saat nilai berubah
kodeInput.addEventListener('input', function() {
    // Menggunakan fungsi slugify untuk membuat slug dari kode surat
    var slugValue = slugify(kodeInput.value);
    slugInput.value = slugValue;
});

// Fungsi untuk membuat slug dari teks
function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spasi dengan tanda hubung
        .replace(/[^\w\-]+/g, '') // Menghapus karakter non-word
        .replace(/\-\-+/g, '-') // Mengganti dua atau lebih tanda hubung dengan satu tanda hubung
        .replace(/^-+/, '') // Menghapus tanda hubung di awal teks
        .replace(/-+$/, ''); // Menghapus tanda hubung di akhir teks
}
</script>


<?= $this->endSection('content'); ?>