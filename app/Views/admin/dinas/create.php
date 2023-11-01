<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<div class="content-wrapper ">
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

            <div class="card card-success" >


                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Buat Dinas</h3>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('admin/dinas/save') ?>" method="POST" class="">
                    <?= csrf_field(); ?>
                    <div class="form-group ">
                        <label for="kategori" class="form-label input-group justify-content-center">Nama Dinas</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group text-center">
                        <input type="name" hidden class="form-control" id="slug" name="slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kodeKategori" class="form-label input-group justify-content-center">Kode Dinas</label>
                        <input type="name" name="kode" class="form-control " id="kodedinas">
                    </div>
                    <div class="form-group">
                        <label for="kodeKategori" class="form-label input-group justify-content-center">Urutan Surat
                            Sebelumnya</label>
                        <input type="number" name="urutan" class="form-control " id="urutan">
                    </div>

                    <div class="row text-center" style="padding-bottom: 50px;">
                            <div class="col-md-6">
                             <a href="<?=base_url('admin/dinas');?>">
                             <button class="btn btn-danger" type="button" style="width: 150px;"
                                    data-dismiss="modal">Batal</button>
                             </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success " style="width: 150px;">Tambah
                                    data</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.content-wrapper -->
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
<?=$this->endSection('content');?>