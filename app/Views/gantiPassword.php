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
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center w-auto p-3 "
                    style="margin: auto; height:50%; margin-top: 50px;">
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
                                        provident fugit
                                        tenetur quas eveniet commodi doloremque, ducimus blanditiis. Quo optio commodi
                                        eveniet!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                <input type="password" name="password" id="exampleInputPassword1"
                                                    class="form-control" placeholder="Masukkan Password">
                                                <span class="input-group-text" id="showPassword"
                                                    style="cursor: pointer;"
                                                    onclick="togglePassword('exampleInputPassword1', 'passwordIcon')">
                                                    <i class="fas fa-eye-slash" id="passwordIcon"></i>
                                                </span>
                                            </div>
                                            <small id="passwordHelp" class="form-text text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword2">Konfirmasi Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" name="confirm_password"
                                                    id="exampleInputPassword2" class="form-control"
                                                    placeholder="Konfirmasi Password">
                                                <span class="input-group-text" id="showConfirmPassword"
                                                    style="cursor: pointer;"
                                                    onclick="togglePassword('exampleInputPassword2', 'confirmPasswordIcon')">
                                                    <i class="fas fa-eye-slash" id="confirmPasswordIcon"></i>
                                                </span>
                                            </div>
                                            <small id="confirmPasswordHelp" class="form-text text-danger"></small>
                                        </div>
                                    </div>

                                    <!-- Tombol Batal dan Submit di bawah -->
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: flex-end; padding-top: 60%;">
                                        <a href="<?=base_url('login');?>">
                                            <button type="button" class="btn btn-danger"
                                                style="width: 100px">Batal</button>
                                        </a>
                                        <button type="submit" disabled id="submitButton" class="btn btn-primary"
                                            style="width: 100px" onclick="validatePassword()">Submit</button>
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById("exampleInputPassword1");
        const confirmPasswordInput = document.getElementById("exampleInputPassword2");
        const passwordIcon = document.getElementById("passwordIcon");
        const confirmPasswordIcon = document.getElementById("confirmPasswordIcon");

        passwordIcon.addEventListener("click", function() {
            togglePassword('exampleInputPassword1', 'passwordIcon');
        });

        confirmPasswordIcon.addEventListener("click", function() {
            togglePassword('exampleInputPassword2', 'confirmPasswordIcon');
        });

        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                passwordIcon.className = "fas fa-eye-slash";
            }

            // Validate password after toggling visibility
            validatePassword();
        }
    });

    function validatePassword() {
        var password = document.getElementById("exampleInputPassword1").value;
        var confirmPassword = document.getElementById("exampleInputPassword2").value;

        // Reset previous error messages
        document.getElementById("confirmPasswordHelp").innerText = "";
        document.getElementById("passwordHelp").innerText = "";

        // Password strength validation
        var lowercaseRegex = /[a-z]/;
        var uppercaseRegex = /[A-Z]/;
        var digitRegex = /[0-9]/;

        var passwordStrengthValid =
            lowercaseRegex.test(password) && uppercaseRegex.test(password) && digitRegex.test(password);

        // Check if passwords match
        var passwordsMatch = password === confirmPassword;

        // Update error messages
        if (!passwordStrengthValid) {
            document.getElementById("passwordHelp").innerText =
                "Password harus mengandung setidaknya 1 huruf kecil, 1 huruf besar, dan 1 angka.";
        }

        if (!passwordsMatch) {
            document.getElementById("confirmPasswordHelp").innerText = "Password tidak sesuai";
        }

        // Enable or disable the submit button based on conditions
        var submitButton = document.getElementById("submitButton");
        submitButton.disabled = !passwordStrengthValid || !passwordsMatch;

        return passwordStrengthValid && passwordsMatch;
    }
    </script>

</body>

</html>