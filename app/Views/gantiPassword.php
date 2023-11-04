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

    <!-- Akhir Navbar -->

    <!-- Form Login -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center w-auto p-3 "
                    style="margin: auto; height:50%; margin-top: 50px;">
                    <?php if (session('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <li><?=esc(session('errors'))?></li>
                        </ul>
                    </div>
                    <?php endif;?>

                    <!-- Logo Aplikasi -->
                    <div class="col-md-4 mt-2">
                        <div class="card p-3  bg-success bg-gradient text-white" style="height: 100%;">
                            <div class="card-body ">
                                <div class=" text-center">
                                    <div class="ms-1 d-flex flex-column"
                                        style=" text-shadow: 2px 2px 1px grey; font-weight: bold; ">
                                        <span class="fs-6">E-NOMOR</span>
                                        <span class="fs-6">KOMINFO SANTI</span>
                                    </div>
                                    <img src="<?php echo base_url('img/logo-kabupaten-buleleng.png') ?>"
                                        alt="Pemkab Buleleng" style="max-width: 40%; ">
                                    <img src="/img/logo_kominfosanti_buleleng.png" alt="" style="max-width: 49%; ">

                                </div>
                                <hr>
                                <div class=" text-center">
                                    <p>Fungsi Aplikasi : Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Repudiandae, dolorem voluptas suscipit magnam autem beatae atque facilis
                                        provident fugit tenetur quas eveniet commodi doloremque, ducimus blanditiis. Quo
                                        optio commodi eveniet!</p>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Form Login -->
                    <!-- Form Login -->
                    <div class="col-md-4 mt-2">
                        <div class="card shadow-lg p-3 .bg-light.bg-gradient" style="height: 100%;">
                            <div class="card-body">
                                <form id="quickForm" method="post" action="<?=base_url('gantipassworduser');?>">
                                    <div class="card-body">
                                        <div class="input-group justify-content-center my-4">
                                            <h2>Reset Password</h2>
                                        </div>
                                        <input type="hidden" name="email" value="<?=$email;?>">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" minlength="8" required name="password"
                                                    id="exampleInputPassword1" class="form-control"
                                                    placeholder="Masukkan Password">
                                                <span class="input-group-text" id="showPassword"
                                                    style="cursor: pointer;">
                                                    <i class="fas fa-eye-slash" id="passwordIcon"></i>
                                                </span>
                                            </div>
                                            <small id="passwordHelp" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <!-- Tombol Batal dan Submit di bawah -->
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: flex-end; padding-top: 60%;; ">
                                        <a href="<?=base_url('login');?>">
                                            <button type="button" class="btn btn-danger"
                                                style="width: 100px">Batal</button>
                                        </a>
                                        <button type="submit" class="btn btn-primary"
                                            style="width: 100px">Submit</button>
                                    </div>
                                    <!-- Akhir Tombol Batal dan Submit -->
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
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