<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<div class="content-wrapper">
    <?php if (session('success')): ?>
    <div class="alert alert-success">
        <ul>
            <li><?=esc(session('success'))?></li>
        </ul>
        <button id="dismissError" class="btn btn-secondary">Ok</button>
    </div>
    <?php endif;?>
    <?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
            <li><?=esc($error)?></li>
            <?php endforeach;?>
        </ul>
        <button id="dismissError" class="btn btn-success">Ok</button>
    </div>
    <?php endif;?>
    <?php if (session('error')): ?>
    <div class="alert alert-danger">
        <ul>
            <li><?=esc(session('error'))?></li>
        </ul>
        <button id="dismissError" class="btn btn-success">Ok</button>
    </div>
    <?php endif;?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="" style="padding-top:1%; ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form method="POST" action="<?=base_url('admin/defaultPassword/update')?>">
                                <input type="hidden" name="id" value="<?=$default['id']?>">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Password Default</label>
                                    <input type="text" name="password" value="<?=$default['password_default']?>"
                                        class="form-control" id="password" placeholder="Masukkan Password Default">
                                    <div class="row text-center" style="padding-bottom: 50px;">
                                        <div class="col-md-12">
                                            <button id="submitButton" type="submit" class="btn btn-success"
                                                style="width: 150px;">Kirim
                                            </button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>.
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dismissButton = document.getElementById("dismissError");
    const errorAlert = document.querySelector(".alert.alert-danger");

    dismissButton.addEventListener("click", function() {
        errorAlert.style.display = "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const dismissButton = document.getElementById("dismissError");
    const errorAlert = document.querySelector(".alert.alert-success");

    dismissButton.addEventListener("click", function() {
        errorAlert.style.display = "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
    });
});
</script>

<?=$this->endSection('content');?>