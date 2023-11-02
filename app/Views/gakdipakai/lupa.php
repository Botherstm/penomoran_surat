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
    <!-- Navbar -->
    <div class="content-wrapper">
        
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
                    <div class="col-md-4 mt-2">
                        <div class="card shadow-lg p-3 .bg-light.bg-gradient">
                            <div class="card-body">
                            <form method="post" action="<?=base_url('lupapw');?>">
                <div class="card-body">

                    <div class="form-group" style=" padding-top: 5%; padding-bottom: 5%; ">
                        <label for="exampleInputEmail1">Kirim Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            placeholder="Enter email">
                    </div>
                </div>

                <div class="card-footer " style="justify-content: space-between; display: flex; ">
                    <a href="<?=base_url('login');?>"><button type="button" class="btn btn-danger"
                            style=" width: 100px ">Batal</button></a>
                    <button type="submit" class="btn btn-primary" style=" width: 100px ">Submit</button>
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