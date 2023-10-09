<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Surat</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        padding: 20px;
        max-width: 400px;
        width: 100%;
        animation: slide-in 0.5s ease;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group select,
    .form-group input[type="text"],
    .form-group input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group select {
        appearance: none;
        background-image: url("arrow-down.png");
        background-repeat: no-repeat;
        background-position: right center;
    }

    @keyframes slide-in {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Form Surat</h2>
        <form action="process_form.php" method="POST">
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select name="kategori" id="kategori">
                    <?php foreach ($kategories as $kategori) : ?>
                    <option value="<?= $kategori['id']; ?>"><?= $kategori['name']; ?></option>
                    <?php endforeach; ?>
                    <!-- <option value="kategori2">Kategori 2</option>
                    <option value="kategori3">Kategori 3</option> -->
                </select>
            </div>
            <div class="form-group">
                <label for="perihal">Perihal:</label>
                <select name="perihal" id="perihal">
                    <option value="perihal1">Perihal 1</option>
                    <option value="perihal2">Perihal 2</option>
                    <option value="perihal3">Perihal 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subperihal">Subperihal:</label>
                <select name="subperihal" id="subperihal">
                    <option value="subperihal1">Subperihal 1</option>
                    <option value="subperihal2">Subperihal 2</option>
                    <option value="subperihal3">Subperihal 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="detail-subperihal">Detail Subperihal Surat:</label>
                <select name="detail-subperihal" id="detail-subperihal">
                    <option value="detail-subperihal1">Detail Subperihal 1</option>
                    <option value="detail-subperihal2">Detail Subperihal 2</option>
                    <option value="detail-subperihal3">Detail Subperihal 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama">
            </div>
            <div class="form-group">
                <label for="instansi">Instansi:</label>
                <input type="text" name="instansi" id="instansi">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>