<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E Nomor Pemkab Buleleng</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <style>
    .navbar {
        background-color: rgba(32, 201, 151, 255);
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow position-relative">
        <div class="container">
            <a class="navbar-brand d-flex" href="#">
                <img src="<?php echo base_url() ?>img/logo-kabupaten-buleleng.png" alt="Pemkab Buleleng"
                    style="width: 70px;">
                <div class="ms-1 d-flex flex-column align-items-start"
                    style="padding-left: 15px; padding-top: 5px; text-shadow: 2px 2px 1px grey; font-weight: bold; ">
                    <span>E-NOMOR</span>
                    <span class="small">KOMINFO SANTI</span>
                </div>
            </a>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Login -->
    <div class="container" style="padding-top: 5%; width: 50%;">
        <div class="card">
            <div class="card-header" style="background-color: #007bff;">
                <h3 class="card-title" style="color: white; display: flex; justify-content: center;">Lupa Password</h3>
            </div>
            <form id="quickForm" method="post" action="<?=base_url('resetpassworduser');?>">
                <input type="hidden" name="email" value="<?=$userToken['email'];?>">
                <input type="hidden" name="token" value="<?=$userToken['token'];?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Baru</label>
                        <div class="input-group">
                            <input type="password" required name="password" id="exampleInputPassword1"
                                class="form-control" placeholder="Masukkan Password">
                            <span class="input-group-text" id="showPassword" style="cursor: pointer;">
                                <i class="fas fa-eye-slash" id="passwordIcon"></i>
                            </span>
                        </div>
                        <small id="passwordHelp" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="card-footer" style="justify-content: space-between; display: flex;">
                    <a href="<?=base_url('login');?>"><button type="submit" class="btn btn-danger"
                            style="width: 100px">Batal</button></a>
                    <button type="submit" class="btn btn-primary" style="width: 100px">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById("exampleInputPassword1");
        const passwordIcon = document.getElementById("passwordIcon");

        passwordIcon.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                passwordIcon.className = "fas fa-eye-slash";
            }
        });
    });
    </script>

    <?php if (session()->getFlashdata('error')): ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo session()->getFlashdata('error'); ?>',
    });
    </script>
    <?php endif;?>
    <?php if (session()->getFlashdata('success')): ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '<?php echo session()->getFlashdata('success'); ?>',
    });
    </script>
    <?php endif;?>

</body>

</html>