<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
.jarak {
    padding-top: 50px;
    padding-left: 25px;
    padding-right: 25px;
    padding-bottom: 70px;
    justify-content: space-between;
}

.halpad {
    padding: 30px 50px 10px 50px;
}
</style>


<div class="content-wrapper halpad">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Edit User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">NIP</label>
                <input type="text" value="<?= $user['nip'] ?>" name="nip" class="form-control"
                    id="exampleFormControlInput1" placeholder="Masukkan NIP">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" value="<?= $user['name'] ?>" name="name" class="form-control" id="name"
                    placeholder="Masukkan NIP">
            </div>
            <div class="form-group text-center">
                <input type="text" value="<?= $user['slug'] ?>" class="form-control" id="slug" name="slug" readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" value="<?= $user['email'] ?>" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">No Telp.</label>
                <input type="number" value="<?= $user['no_hp'] ?>" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukan No. Telp">
            </div>


            <div class="form-group">
                <label for="exampleFormControlInput1">Dinas</label>
                <input type="number" value="<?= $instansi->ket_ukerja ?>" class="form-control"
                    id="exampleFormControlInput1">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Dinas</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Bidang</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="row jarak">
                <button type="submit" class="btn btn-danger" style="width: 150px;">Batal</button>
                <button type="submit" class="btn btn-success" style="width: 150px;">Konfirmasi</button>
            </div>
        </form>
    </section>
    <!-- /.content -->
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
<?= $this->endSection('content'); ?>