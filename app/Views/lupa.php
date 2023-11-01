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

    <style>
    .navbar {
        background-color: rgba(32, 201, 151, 255);
    }

    .slide-up {
        transform: translateY(0);
        /* Kondisi awal */
        transition: transform 0.5s ease-in-out;
        /* Waktu animasi dan jenis transisi */
    }

    .slide-up.active {
        transform: translateY(100%);
        /* Kondisi akhir (tersembunyi di atas) */
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow position-relative ">
        <div class="container ">
            <a class="navbar-brand d-flex" href="#">
                <img src="<?php echo base_url('img/logo-kabupaten-buleleng.png') ?>" alt="Pemkab Buleleng"
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
    <div class="container slide-up active" style="padding-top: 5%; width: 50%; ">
        <div class="card  " >
            <div class="card-header "
                style="background-color: #007bff ;   box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); ">
                <h3 class="card-title  " style=" color: white;  display: flex;
    justify-content: center;  ">Lupa Password</h3>
            </div>

            <form method="post" action="<?=base_url('lupapw');?>">
                <div class="card-body">

                    <div class="form-group" style=" padding-top: 5%; padding-bottom: 5%; " >
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

    <script>
    // Untuk mengaktifkan animasi saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        const slideUpElement = document.querySelector(".slide-up");
        // Hilangkan kelas "active" untuk memulai animasi
        slideUpElement.classList.remove("active");
    });
    </script>

</body>

</html>