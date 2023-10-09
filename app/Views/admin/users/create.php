<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content'); ?>
<style>
.album-container {
    animation: fadeInUp 1s ease;
    text-align: center;
    /* Center-align content within .album-container */
}

.album-form {
    max-width: 500px;
    margin: 0 auto;
    text-align: left;
    /* Reset text alignment for the form */
}

.album-image-preview {
    max-width: 300px;
    margin-bottom: 20px;
    display: block;
    margin: 0 auto;
    /* Center-align the image preview */
}

/* Add text-center class to center-align the form button */
.text-center button {
    margin: 0 auto;
    display: block;
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
            <h2 class="text-center">Create Users</h2>
            <form class="album-form" method="POST" action="<?php echo base_url() ?>admin/user/save"
                enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group text-center">
                    <label for="instansi_id">Pilih Dinas</label>
                    <select class="form-control" id="instansi_id" name="instansi_id">
                        <?php foreach ($dinass->data as $dinas) : ?>
                        <option value="<?= $dinas->id_instansi; ?>">
                            <?= $dinas->ket_ukerja; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group text-center">
                    <label for="bidang_id">Pilih Bidang</label>
                    <select class="form-control" id="bidang_id" name="bidang_id">
                        <?php foreach ($bidangs as $bidang) : ?>
                        <option value="<?= $bidang['id']; ?>">
                            <?= $bidang['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group text-center">
                    <label for="name">Name</label>
                    <input type="text"
                        class="form-control <?= (isset($validation) && $validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                        id="name" name="name" autofocus>
                    <?php if (isset($validation) && $validation->hasError('name')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('name'); ?>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="form-group text-center">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" readonly>
                </div>

                <div class="form-group text-center">
                    <label for="nip">NIP</label>
                    <input type="number"
                        class="form-control <?= (isset($validation) && $validation->hasError('nip')) ? 'is-invalid' : ''; ?>"
                        id="nip" name="nip" autofocus>
                    <?php if (isset($validation) && $validation->hasError('nip')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nip'); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group text-center">
                    <label for="email">Email</label>
                    <input type="email"
                        class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                        id="email" name="email" autofocus>
                    <?php if (isset($validation) && $validation->hasError('email')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group text-center">
                    <label for="no_hp">no_hp</label>
                    <input type="number"
                        class="form-control <?= (isset($validation) && $validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>"
                        id="no_hp" name="no_hp" autofocus>
                    <?php if (isset($validation) && $validation->hasError('no_hp')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_hp'); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group text-center">
                    <label for="password">Password</label>
                    <input type="password"
                        class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                        id="password" name="password" autofocus>
                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
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
var nameInput = document.getElementById('name');
var slugInput = document.getElementById('slug');

// Function to generate a slug from the given string
function slugify(text) {
    return text.toString().toLowerCase()
        .trim()
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/[^\w\-]+/g, '') // Remove non-word characters (except dashes)
        .replace(/\-\-+/g, '-') // Replace multiple dashes with a single dash
        .substring(0, 50); // Limit the slug length
}

// Add an input event listener to the name input field
nameInput.addEventListener('input', function() {
    var nameValue = nameInput.value;
    var slugValue = slugify(nameValue);
    slugInput.value = slugValue;
});
</script>

<?= $this->endSection('content'); ?>