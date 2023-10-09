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
            <h2 class="text-center">Create Data Bidang</h2>
            <form class="album-form" method="POST" action="<?php echo base_url() ?>admin/bidang/save"
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

                <div class="form-group">
                    <label for="instansi_id">Pilih Dinas</label>
                    <select class="form-control" id="instansi_id" name="instansi_id">
                        <?php foreach ($dinass as $dinas) : ?>
                        <option value="<?= $dinas->id_instansi; ?>">
                            <?= $dinas->ket_ukerja; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kode">Kode</label>
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


<?= $this->endSection('content'); ?>