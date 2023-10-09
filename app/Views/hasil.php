<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Generate Nomor Surat</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #000;
    }

    .neon-container {
        position: relative;
        text-align: center;
    }

    .neon-glow {
        font-size: 2rem;
        /* Ukuran font disesuaikan dengan layar */
        color: transparent;
        text-transform: uppercase;
        font-family: 'Arial', sans-serif;
        letter-spacing: 5px;
        animation: neon 3s ease-in-out infinite alternate;
        /* Durasi diperpanjang menjadi 3 detik */
    }

    .nomor-surat {
        display: inline-block;
        padding: 10px;
        /* Ukuran padding disesuaikan dengan layar */
        background-color: #330066;
        /* Warna ungu */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(51, 0, 102, 0.5);
        /* Efek bayangan */
    }

    @keyframes neon {
        0% {
            text-shadow: 0 0 5px rgba(255, 0, 255, 1);
            /* Kurangi efek blur */
        }

        50% {
            text-shadow: 0 0 10px rgba(255, 0, 255, 0.7);
            /* Efek denyut pada 50% animasi */
        }

        100% {
            text-shadow: 0 0 5px rgba(255, 0, 255, 1);
            /* Kembali ke efek awal */
        }
    }

    @media (max-width: 768px) {

        /* Ukuran font dan padding yang berbeda untuk layar yang lebih kecil */
        .neon-glow {
            font-size: 1.5rem;
        }

        .nomor-surat {
            padding: 5px;
        }
    }
    </style>
</head>

<body>
    <div class="neon-container">
        <div class="neon-glow">
            <div class="nomor-surat">
                <span id="generatedNomorSurat"><?php echo $nomorsurat; ?></span>
            </div>
        </div>
    </div>
</body>

</html>