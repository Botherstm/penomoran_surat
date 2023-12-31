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
                <img src="<?php echo base_url('img/logo-kabupaten-buleleng.png') ?>" alt="Pemkab Buleleng" style="width: 70px;">
                <div class="ms-1 d-flex flex-column align-items-start" style="padding-left: 15px; padding-top: 5px; text-shadow: 2px 2px 1px grey; font-weight: bold; ">
                    <span>E-NOMOR</span>
                    <span class="small">KOMINFO SANTI</span>
                </div>
            </a>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Login -->
    <div class="container" style="padding-bottom: 10%;">
        <div class="row mt-2 m-auto" style="width: 25%;">
            <img class="d-flex" src="<?php echo base_url('img\logo.png') ?>" alt="">
        </div>
        <div class="row">
            <div class="col">
                <div class="card row m-auto mt-1 shadow" style="width: 40%; padding-bottom: 5%;">
                    <div class="card-body row m-auto">
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
                            <div class="mb-1" style="padding-bottom: 5%;">
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
                            <div class="d-grid gap-2 col-6 mx-auto mb-1">
                                <button class="btn btn-success text-light" type="submit">Login</button>
                            </div>
                        </form>

                        <a href="<?php echo base_url('lupa') ?>" class="text-center d-block mx-auto">Lupa Password?</a>

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
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo session()->getFlashdata('error'); ?>',
            });
        </script>
    <?php endif; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitButton = form.querySelector("button");
            const recaptcha = document.querySelector(".g-recaptcha");

            // Nonaktifkan tombol "Login" saat halaman dimuat
            submitButton.disabled = false;

            recaptcha.addEventListener("change", function() {
                const recaptchaResponse = grecaptcha.getResponse();
                // Aktifkan tombol "Login" jika reCAPTCHA diverifikasi
                if (recaptchaResponse.length > 0) {
                    submitButton.disabled = false;
                }
            });
        });
    </script>

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