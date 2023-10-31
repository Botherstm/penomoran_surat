<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Main content -->
            <!-- <div class="row jarak ">
                    <div class="card-tools">
                        <div class="btnadd">
                        </div>
                    </div>
                    <div class="card-tools">
                    </div>
                </div> -->

            <div class="card card-warning">


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Edit Data Sub-Perihal <?=$subperihal['name'];?>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('admin/subperihal/update/') ?><?= $subperihal['id']; ?>"
                        method="POST" class="">
                        <?= csrf_field(); ?>

                        <div class="mb-5 m-1 ">
                            <label for="kategori" class="form-label input-group ">Sub Perihal</label>
                            <input type="text" class="form-control  " value="<?= $subperihal['name']; ?>" name="name"
                                id="name" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group text-center">
                            <input type="name" hidden class="form-control" id="detail_id" name="detail_id"
                                value="<?= $perihal['id']; ?>" readonly>
                        </div>
                        <div class="form-group text-center">
                            <input type="name" hidden value="<?= $subperihal['slug']; ?>" class="form-control" id="slug"
                                name="slug" readonly>
                        </div>
                        <div class="mb-5 m-1">
                            <label for="kodeKategori" class="form-label input-group">Kode Sub Perihal</label>
                            <input type="name" value="<?= $subperihal['kode']; ?>" name="kode" class="form-control "
                                id="kodeKategori">
                        </div>
                        <div class="row text-center">
                            <div class="col-md-6" style="padding-bottom: 10px;">
                                <a
                                    href="<?php echo base_url('admin/kategori/perihal/subperihal/') ?><?= $perihal['slug']; ?>">
                                    <button type="button" class="btn btn-danger" style="width: 30%;  ">Batal</button>
                                </a>
                            </div>
                            <div class="col-md-6" style="padding-bottom: 10px;">
                                <button type="submit" class="btn btn-success "
                                    style="width: 30%; padding-bottom: 10px;">Ubah data</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
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