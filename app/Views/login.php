<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E Nomor Pemkab Buleleng</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <div class="row d-flex justify-content-center w-auto p-3 "
                    style="margin: auto; height:5%; margin-top: 1%;">
                    <?php if (session('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <li><?=esc(session('errors'))?></li>
                        </ul>
                        <button id="dismissError" class="btn btn-dark" style="width: 10%;" >Hide</button>
                    </div>
                    <?php endif;?>

                    <!-- Logo Aplikasi -->
                    <div class="col-md-5">
                        <div class="card shadow-lg bg-success bg-gradient text-white "
                            style="height: 95%; --bs-bg-opacity: .9;">
                            <div class="card-body ">
                                <div class=" text-center">

                                    <img src="<?php echo base_url('img/logo-kabupaten-buleleng.png') ?>" alt="Pemkab Buleleng" style="max-width: 20%; ">
                                    <img src="/img/logo_kominfosanti_buleleng.png" alt="" style="max-width: 25%; ">

                                </div>
                                <hr>
                                <div class=" text-center ">
                                    <h6 style=" font-size: small; "><small>VISI PEMBANGUNAN KABUPATEN BULELENG</small>
                                    </h6>
                                    <p style=" font-size: small; "><small>“TERWUJUDNYA MASYARAKAT BULELENG YANG MANDIRI
                                            SEJAHTERA DAN BERDAYA SAING BERLANDASKAN TRI HITA KARANA”</small></p>
                                </div>
                                <div>
                                    <h6 class=" text-center " style=" font-size: small; "><small>MISI PEMBANGUNAN
                                            KABUPATEN BULELENG</small></h6>
                                    <small>
                                        <ol style="font-size: smaller;">
                                            <li>Memantapkan Pembangunan Ekonomi untuk Mewujudkan Pertumbuhan Ekonomi
                                                yang Inklusif;</li>
                                            <li>Pengembangan Ekonomi Kerakyatan yang Berbasis pada Produk Unggulan
                                                Daerah;</li>
                                            <li>Meningkatkan Kualitas Sumber Daya Manusia yang Profesional, Berbudaya
                                                dan Berintegritas; </li>
                                            <li>Memantapkan Partisipasi Pemangku Kepentingan Dalam Pembangunan;</li>
                                            <li>Meningkatkan Kuantitas dan Kualitas Infrastruktur Daerah untuk Pemenuhan
                                                Pelayanan Publik;</li>
                                            <li>Mewujudkan Pembangunan Buleleng yang Berbudaya dan Berkelanjutan
                                                (Sustainable Development).</li>
                                        </ol>
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Form Login -->
                    <div class="col-md-4 mt-2">
                        <div class="card shadow-lg p-3 bg-dark bg-gradient" style="height: 95%; --bs-bg-opacity: .1;">
                            <div class="card-body">
                                <form class="form" method="POST" action="<?php echo base_url('login') ?>">
                                    <?=csrf_field();?>
                                    <div class="text-center ">
                                        <div class=" d-flex flex-column" style=" font-weight: bold; ">
                                            <span class="fs-6">E-NOMOR</span>
                                            <span class="fs-7">KOMINFO SANTI</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="input-group justify-content-center mb-2 ">
                                        <h2>LOGIN</h2>
                                    </div>
                                    <div class="mb-3 ">
                                        <div class="input-group">
                                            <input type="email" class="shadow form-control" name="email"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" required
                                                placeholder="Email" style="opacity: 0.7;">
                                            <i class="shadow input-group-text bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="mb-2" style="padding-bottom: 6%;">
                                        <div class=" input-group ">
                                            <input type="password"
                                                class="shadow form-control <?=($validation->hasError('password')) ? 'is-invalid' : '';?>"
                                                required id="exampleInputPassword1" placeholder="Password"
                                                name="password" style="opacity: 0.7;">
                                            <?php if ($validation->hasError('password')): ?>
                                            <div class="invalid-feedback">
                                                <?=$validation->getError('password');?>
                                            </div>
                                            <?php endif;?>
                                            <span class="shadow input-group-text bi bi-eye-slash"
                                                id="showPassword"></span>
                                        </div>
                                    </div>
                                    <div class="g-recaptcha " data-sitekey="<?=$key;?>"
                                        style="width: 100%; max-width: auto; margin: 0 auto;"></div>
                                    <br>
                                    <div class="d-grid gap-2 col-6 mx-auto mb-3">
                                        <button class="shadow text-light btn btn-success" type="submit">Login</button>
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
    <?php if (session()->getFlashdata('success')): ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '<?php echo session()->getFlashdata('success'); ?>',
    });
    </script>
    <?php endif;?>


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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const dismissButton = document.getElementById("dismissError");
        const errorAlert = document.querySelector(".alert.alert-danger");

        dismissButton.addEventListener("click", function() {
            errorAlert.style.display =
                "none"; // Menyembunyikan pesan kesalahan saat tombol "Ok" ditekan
        });
    });
    </script>
</body>

</html>