<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<style>
    /* Tambahkan CSS berikut */
    .content-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .card-wrapper {
        display: flex;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        margin: 10px;
        /* Atur margin sesuai kebutuhan Anda */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        /* Membuat tinggi kartu sama */
    }

    /* CSS untuk gambar profil */
    .profile-img {
        cursor: pointer;
        width: 150px;
        height: 150px;
        padding-bottom: 5%;
    }

    /* CSS untuk keterangan yang awalnya tersembunyi */
    .profile-info {
        display: none;
        width: 150px;
        transition: width 0.5s, opacity 0.5s;
    }

    .card-text {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card-wrapper">
                    <div class="card col-md-7">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Tentang Aplikasi</h5>
                        </div>
                        <div class="card-body">
                            <div class=" text-center">
                                <img class="" src="/img/logo_kominfosanti_buleleng.png" alt="" style="max-width: 100%; max-height: 200px;">
                            </div>
                            <div class=" text-center">
                                <p>Fungsi Aplikasi : Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Repudiandae, dolorem voluptas suscipit magnam autem beatae atque facilis
                                    provident fugit tenetur quas eveniet commodi doloremque, ducimus blanditiis. Quo
                                    optio commodi eveniet!</p>

                                <p>Fungsi Aplikasi : Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Repudiandae, dolorem voluptas suscipit magnam autem beatae atque facilis
                                    provident fugit tenetur quas eveniet commodi doloremque, ducimus blanditiis. Quo
                                    optio commodi eveniet!</p>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-5">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Pengembang Website</h5>
                        </div>
                        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                            <div class="container-fluid">
                                <div class="row g-0" style="display: flex; justify-content: center; ">
                                    <div class="card-wrapper">
                                        <div class="col ">
                                            <img src="<?php echo base_url('/img/james.jpg') ?>" style="border-radius: 100%;" class="profile-img" id="profile-img-james">
                                            <h5 class="card-text" style="font-weight: bold; text-align: center; " id="profile-name-james" >James Pieter Loro</h5>
                            
                                        </div>
                                    </div>
                                    <div class="profile-info " id="profile-info-james">
                                        <h5 class="card-text" style="font-weight: bold; padding-left: 40px; ">James Pieter Loro</h5>
                                        <ul class="card-text">
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos cum unde repudiandae asperiores sint exercitationem, saepe possimus aspernatur dolores corporis laboriosam sapiente incidunt sunt quam, nobis cupiditate temporibus nam illum.</li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <a href="">
                                                <i class="fab fa-instagram" style="font-size: 2em; color: #E4405F; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-facebook" style="font-size: 2em; color: #0052f7; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-github" style="font-size: 2em; color: black;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row g-0" style="display: flex; justify-content: center; ">
                                    <div class="card-wrapper">
                                        <div class="col">
                                            <img src="<?php echo base_url('/img/yanyon.jpeg') ?>" style="border-radius: 100%;" class="profile-img" id="profile-img-yanyon">
                                            <h5 class="card-text" style="font-weight: bold; display: flex; text-align: center; font-size: medium ; " id="profile-name-yanyon" >I Wayan Yoni Maheswara</h5>
                                        </div>
                                    </div>
                                    <div class="profile-info " id="profile-info-yanyon">
                                        <h5 class="card-text" style="font-weight: bold; padding-left: 40px; font-size: medium; ">I Wayan Yoni Maheswara</h5>
                                        <ul class="card-text">
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos cum unde repudiandae asperiores sint exercitationem, saepe possimus aspernatur dolores corporis laboriosam sapiente incidunt sunt quam, nobis cupiditate temporibus nam illum.</li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <a href="">
                                                <i class="fab fa-instagram" style="font-size: 2em; color: #E4405F; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-facebook" style="font-size: 2em; color: #0052f7; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-github" style="font-size: 2em; color: black;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                                <div class="row g-0" style="display: flex; justify-content: center; ">
                                    <div class="card-wrapper">
                                        <div class="col">
                                            <img src="<?php echo base_url('/img/yasoda.jpeg') ?>" style="border-radius: 100%;" class="profile-img" id="profile-img-yasoda">
                                            <h5 class="card-text" style="font-weight: bold; display: flex; text-align: center;  " id="profile-name-yasoda" >Yasoda</h5>
                                        </div>
                                    </div>
                                    <div class="profile-info " id="profile-info-yasoda">
                                        <h5 class="card-text" style="font-weight: bold; padding-left: 40px;">Yasoda</h5>
                                        <ul class="card-text">
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos cum unde repudiandae asperiores sint exercitationem, saepe possimus aspernatur dolores corporis laboriosam sapiente incidunt sunt quam, nobis cupiditate temporibus nam illum.</li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <a href="">
                                                <i class="fab fa-instagram" style="font-size: 2em; color: #E4405F; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-facebook" style="font-size: 2em; color: #0052f7; margin-right: 30px;"></i>
                                            </a>
                                            <a href="">
                                                <i class="fab fa-github" style="font-size: 2em; color: black;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk menambahkan fungsi klik pada gambar profil
        function setupProfileImageToggle(profileImgId, profileInfoId, profileNameId) {
            const profileImg = document.getElementById(profileImgId);
            const profileInfo = document.getElementById(profileInfoId);
            const profileName = document.getElementById(profileNameId);

            let isTextVisible = true;
            let isInfoVisible = false;

            profileImg.addEventListener("click", () => {
                if (!isInfoVisible) {
                    // Tampilkan keterangan dengan animasi slide
                    profileInfo.style.display = "block";
                    profileInfo.style.width = "300px";
                    profileInfo.style.opacity = "1";
                    profileImg.style.width = "100px";
                    profileImg.style.height = "100px";
                    profileImg.style.marginTop = "20px";
                    profileName.style.display = "none";
                } else {
                    // Sembunyikan keterangan dengan animasi slide
                    profileInfo.style.width = "0";
                    profileInfo.style.opacity = "0";
                    setTimeout(() => {
                        profileInfo.style.display = "none";
                    }, 500); // Waktu animasi (0.5 detik)
                    profileImg.style.width = "150px"; // Kembalikan ukuran gambar ke semula
                    profileImg.style.height = "150px";
                    profileName.style.display = "block";
                }

                isInfoVisible = !isInfoVisible;
                isTextVisible = !isTextVisible;
            });
        }

        setupProfileImageToggle("profile-img-james", "profile-info-james", "profile-name-james");
        setupProfileImageToggle("profile-img-yanyon", "profile-info-yanyon", "profile-name-yanyon");
        setupProfileImageToggle("profile-img-yasoda", "profile-info-yasoda", "profile-name-yasoda");
    </script>

</body>

<?= $this->endSection('content'); ?>
