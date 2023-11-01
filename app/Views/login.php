<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E Nomor Pemkab Buleleng</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Ldc6pQoAAAAAOgAa4PU6aT8GwfhXH61llUBzIEy">
    </script>


</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row d-flex justify-content-center w-auto p-3 " style="margin: auto; height:50%; margin-top: 50px;">
                    <?php if (session('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <li><?= esc(session('errors')) ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Logo Aplikasi -->
                    <div class="col-md-4 ">
                        <div class="card p-3  bg-success bg-gradient text-white">
                            <div class="card-body ">
                                <div class=" text-center">
                                    <div class="ms-1 d-flex flex-column" style=" text-shadow: 2px 2px 1px grey; font-weight: bold; ">
                                        <span class="fs-6">E-NOMOR</span>
                                        <span class="fs-6">KOMINFO SANTI</span>
                                    </div>
                                    <img src="<?php echo base_url('img/logo-kabupaten-buleleng.png') ?>" alt="Pemkab Buleleng" style="max-width: 40%; ">
                                    <img src="/img/logo_kominfosanti_buleleng.png" alt="" style="max-width: 49%; ">

                                </div>
                                <hr>
                                <div class=" text-center">
                                    <p>Fungsi Aplikasi : Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae, dolorem voluptas suscipit magnam autem beatae atque facilis provident fugit tenetur quas eveniet commodi doloremque, ducimus blanditiis. Quo optio commodi eveniet!</p>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Form Login -->
                    <div class="col-md-4 ">
                        <div class="card shadow-lg p-3 .bg-light.bg-gradient">
                            <div class="card-body">
                                <form class="form" method="POST" action="<?php echo base_url('login') ?>">
                                    <?= csrf_field(); ?>
                                    <div class="input-group justify-content-center my-4">
                                        <h2>LOGIN</h2>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Email" style="opacity: 0.7;">
                                            <i class="input-group-text bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="mb-2" style="padding-bottom: 10%;">
                                        <div class="input-group">
                                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" required id="exampleInputPassword1" placeholder="Password" name="password" style="opacity: 0.7;">
                                            <?php if ($validation->hasError('password')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('password'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <span class="input-group-text bi bi-eye-slash" id="showPassword"></span>
                                        </div>
                                    </div>
                                    <div class="g-recaptcha " data-sitekey="<?= $key; ?>" style="width: 100%; max-width: 300px; margin: 0 auto;"></div>
                                    <br>
                                    <div class="d-grid gap-2 col-6 mx-auto mb-3">
                                        <button class="btn btn-success text-light" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo session()->getFlashdata('success'); ?>',
            });
        </script>
    <?php endif; ?>


    <script>
        function showAlert() {
            Swal.fire('berhasil');
        }
        const passwordInput = document.getElementById("exampleInputPassword1");
        const showPasswordIcon = document.getElementById("showPassword");

        showPasswordIcon.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordIcon.classList.remove("bi-eye-slash");
                showPasswordIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                showPasswordIcon.classList.remove("bi-eye");
                showPasswordIcon.classList.add("bi-eye-slash");
            }
        });
    </script>

</body>

</html>