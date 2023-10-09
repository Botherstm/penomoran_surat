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
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow position-relative"
        style="background-color: rgb(8, 164, 167);">
        <div class="container">
            <a class="navbar-brand d-flex" href="#">
                <img src="<?php echo base_url() ?>img/logo-kabupaten-buleleng.png" alt="Pemkab Buleleng" style="width: 70px;">
                <div class="ms-2 d-flex flex-column align-items-start">
                    <span>E-NOMOR</span>
                    <span class="small">KOMINFO SANTI</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Login -->
    <div class="container">
        <div class="row mt-5 m-auto" style="width: 15%;">
            <img class="d-flex" src="<?php echo base_url() ?>img\logo_kominfosanti_buleleng.png" alt="">
        </div>
        <div class="row">
            <div class="col">
                <div class="card row m-auto mt-1 shadow" style="width: 40%;">
                    <div class="card-body row m-auto">
                        <form class="">
                            <div class="input-group justify-content-center mt-3 mb-3">
                                <h2>LOGIN</h2>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="NIP" style="opacity: 0.7;">
                                    <i class="input-group-text bi bi-person-fill"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="PASSWORD" style="opacity: 0.7;">
                                    <span class="input-group-text bi bi-eye-slash" id="showPassword"></span>
                                </div>
                            </div>
                            <div class="mb-3 rounded-1 text-center">
                                <button type="submit" class="btn btn-primary mx-auto border border-0"
                                    style="background-color: rgb(8, 164, 167);">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Form Login -->

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const passwordInput = document.getElementById("exampleInputPassword1");
        const showPasswordIcon = document.getElementById("showPassword");

        showPasswordIcon.addEventListener("click", function () {
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