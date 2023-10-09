<!DOCTYPE html>
<html lang="en">

<?= $this->include('admin/layouts/navbar'); ?>

<?= $this->include('admin/layouts/sidebar'); ?>

<head>
    <meta charset="UTF-8">
    <title>Upload and Add Text to PDF</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>css/styles.css">
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .upload-container {
        text-align: center;
        margin: 50px auto;
        max-width: 800px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    .file-input {
        position: relative;
        margin: 20px 0;
    }

    .inputfile {
        display: none;
    }

    label {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    label:hover {
        background-color: #2980b9;
    }

    .upload-button {
        background-color: #EAFF05;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-button:hover {
        background-color: #EAFF05;
    }

    .submit-button {
        background-color: #27ae60;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #219651;
    }

    /* Tampilan pratinjau PDF */
    .pdf-container {
        margin-top: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        background-color: white;
        position: relative;
    }

    /* Form untuk koordinat dan teks */
    .coordinate-form {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .coordinate-input {
        margin-bottom: 10px;
        text-align: center;
    }

    .coordinate-input label {
        font-weight: bold;
    }

    .coordinate-input input {
        width: 100px;
        padding: 5px;
        border: 1px solid #ccc;
    }

    /* Teks yang ditambahkan ke pratinjau PDF */
    .added-text {
        position: absolute;
        color: black;
        /* Warna teks */
        font-size: 16px;
        /* Ukuran font */
        white-space: nowrap;
        /* Teks tidak mematahkan baris */
    }
    </style>
</head>

<body>

    <div class="upload-container">
        <h2>Upload and Add Text to PDF</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="file-input">
                <input type="file" name="pdf_file" id="file" class="inputfile" accept=".pdf">
                <label for="file">Choose a PDF file</label>
            </div>
            <!-- Pratinjau PDF -->
            <div class="pdf-container" id="pdf-container">
                <!-- Container untuk pratinjau PDF -->
            </div>
            <!-- Form untuk koordinat dan teks -->
            <div class="coordinate-form">
                <div class="coordinate-input">
                    <label for="x">X Coordinate:</label>
                    <input type="number" name="x" id="x" required>
                </div>
                <div class="coordinate-input">
                    <label for="y">Y Coordinate:</label>
                    <input type="number" name="y" id="y" required>
                </div>
                <div class="coordinate-input">
                    <label for="text">Text to Add:</label>
                    <input type="text" name="text" id="text" required>
                </div>
                <button type="button" class="upload-button" onclick="updatePreview()">Update Preview</button>
                <br>
                <button type="submit" class="submit-button">Generate Nomor</button>

            </div>
        </form>
        <a href="/admin"><button class="submit-button">admin</button></a>
    </div>
    <script>
    // Fungsi untuk menampilkan pratinjau PDF saat unggahan dipilih
    function showPreview() {
        const fileInput = document.getElementById('file');
        const pdfContainer = document.getElementById('pdf-container');

        // Hapus pratinjau yang ada jika ada
        pdfContainer.innerHTML = '';

        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                const dataUri = event.target.result;

                // Buat elemen objek PDF
                const object = document.createElement('object');
                object.data = dataUri;
                object.width = '100%';
                object.height = '600px'; // Ganti tinggi sesuai kebutuhan

                // Tambahkan objek PDF ke kontainer pratinjau
                pdfContainer.appendChild(object);
            };

            reader.readAsDataURL(file);
        }
    }

    // Fungsi untuk mengatur teks pada pratinjau PDF berdasarkan koordinat dan teks yang diatur
    function updatePreview() {
        const x = document.getElementById('x').value;
        const y = document.getElementById('y').value;
        const text = document.getElementById('text').value;

        const pdfContainer = document.getElementById('pdf-container');
        const textElement = document.createElement('div');
        textElement.className = 'added-text';
        textElement.style.position = 'absolute';
        textElement.style.left = x + 'px';
        textElement.style.top = y + 'px';
        textElement.textContent = text;

        pdfContainer.appendChild(textElement);
    }

    // Pasang event listener untuk perubahan pada input file
    const fileInput = document.getElementById('file');
    fileInput.addEventListener('change', showPreview);
    </script>
</body>

</html>