<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View PDF</title>
    <style>
    /* Gaya tampilan Anda dapat ditempatkan di sini */
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .download-button {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #3498db;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .download-button:hover {
        background-color: #2980b9;
    }
    </style>
</head>

<body>
    <!-- Tambahkan tombol untuk mengunduh PDF -->
    <a href="<?= base_url('assets/pdf/' . $filename) ?>" download="nama_file.pdf" class="download-button">
        Unduh PDF
    </a>
</body>

</html>