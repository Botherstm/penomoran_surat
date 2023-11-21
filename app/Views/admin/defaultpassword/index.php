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

            <div class="card card-success">
                <?php if (session('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                        <li><?=esc($error)?></li>
                        <?php endforeach;?>
                    </ul>
                    <button id="dismissError" class="btn btn-dark" style="width: 10%;" >Hide</button>
                </div>
                <?php endif;?>

                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Reset Password</h3>
                </div>
                <div class="card-body">
                <form method="POST" action="<?=base_url('admin/defaultPassword/update')?>">
                                <input type="hidden" name="id" value="<?=$default['id']?>">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Password Default</label>
                                    <input type="text" name="password" value="<?=$default['password_default']?>"
                                        class="form-control" id="password" placeholder="Masukkan Password Default">
                                </div>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
        var passwordInput = document.getElementById("password");
        var password = passwordInput.value;

        if (!isValidPassword(password)) {
            event.preventDefault(); // Mencegah pengiriman formulir jika password tidak valid

            // Menampilkan pesan kesalahan
            var errorDiv = document.createElement("div");
            errorDiv.classList.add("alert", "alert-danger", "small");
            errorDiv.innerHTML =
                "Password harus memiliki 1 huruf kecil, 1 huruf besar, 1 angka dan minimal 8 Karakter";

            var formGroup = document.querySelector(".form-group");
            formGroup.appendChild(errorDiv);
        }
    });

    function isValidPassword(password) {
        // Regex untuk memastikan password memiliki 1 huruf kecil, 1 huruf besar, 1 angka, dan minimal 8 karakter
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        return regex.test(password);
    }

});
</script>


<?=$this->endSection('content');?>