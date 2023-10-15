<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-bottom: 40px; padding-top: 30px;">
        <div class="container-fluid">
            <div class="col">
                <div class="card"
                    style="width: 60%; height: 75%; background: #048c7f; border-radius: 27px; margin: 0 auto; ">
                    <div class="card-header border-0" style="color: white;">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-file mr-1"></i>
                            Generate Surat
                        </h3>
                    </div>

                    <div style="margin: 0 auto; padding-bottom: 20px;">
                        <i style="font-size: 5em; color: white;" class="fas fa-file-pdf"></i>
                    </div>

                    <div style="margin: 0 auto; padding-bottom: 20px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div class="preview-container" style="display: none;">
                            <!-- Preview of the uploaded PDF will be displayed here -->
                        </div>
                    </div>
                    <div class="form-container" style="display: none;">
                        <!-- Your form code goes here -->
                        <form class="text-center">
                            <h1 class="text-center mt-3 mb-3">Generate Nomor Surat</h1>
                            <div class="form-group">
                                <label for="bidang">BIDANG</label>
                                <div class="input-group">
                                    <select class="custom-select" id="bidang">
                                        <option selected>Pilih bidang...</option>
                                        <option value="kategori1">Kategori 1</option>
                                        <option value="kategori2">Kategori 2</option>
                                        <option value="kategori3">Kategori 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <div class="input-group">
                                    <select class="custom-select" id="kategori">
                                        <option selected>Pilih kategori...</option>
                                        <?php foreach ($kategories as $kategori) : ?>
                                        <option value="<?= $kategori['kode'] ?>"><?= $kategori['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-none" id="perihalGroup">
                                <label for="perihal">Perihal</label>
                                <div class="input-group">
                                    <select class="custom-select" id="perihal">
                                        <option selected>Pilih perihal...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-none" id="subPerihalGroup">
                                <label for="subPerihal">Sub Perihal</label>
                                <div class="input-group">
                                    <select class="custom-select" id="subPerihal">
                                        <option selected>Pilih sub perihal...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-none" id="detailSubPerihalGroup">
                                <label for="detailsubPerihal">Detail Sub Perihal</label>
                                <div class="input-group">
                                    <select class="custom-select" id="detailsubPerihal">
                                        <option selected>Pilih detail sub perihal...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomorSurat">Nomor Tercetak</label>
                                <input type="text" class="form-control" id="nomorSurat" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-info" type="button" id="generateButton">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="container-fluid">
        <section class="content">
            <div style="width: 100%; background: #048c7f; padding-top: 10px; padding-bottom: 10px; ">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="simple-results.html">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg"
                                    placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="container-fluid" style="padding-top: 50px; padding-bottom: 50px;">
        <section class="content">
            <div class="col" style="padding-bottom: 50px;">
                <div class="d-flex flex-row justify-content-center">
                    <div class="card-deck">
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to
                                    additional content.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Bootstrap 4</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This card has even longer content than the first to
                                    show that equal height action.</p>
                                <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="card-deck">
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional
                                content.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="gambar4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Belajar Bootstrap 4</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This card has even longer content than the first to show that equal
                                height action.</p>
                            <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

<script>
document.getElementById("inputGroupFile01").addEventListener("change", function(event) {
    const fileInput = event.target;
    const previewContainer = document.querySelector(".preview-container");
    const formContainer = document.querySelector(".form-container");

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];

        // Check if the file is a PDF (you can add more validation if needed)
        if (file.type === "application/pdf") {
            // Display the uploaded PDF in the preview container
            const pdfObject = document.createElement("object");
            pdfObject.data = URL.createObjectURL(file);
            pdfObject.type = "application/pdf";
            pdfObject.style.width = "100%";
            pdfObject.style.height = "400px"; // Adjust the height as needed
            previewContainer.appendChild(pdfObject);

            // Show the form
            previewContainer.style.display = "block";
            formContainer.style.display = "block";
        } else {
            alert("Please upload a PDF file.");
            fileInput.value = ""; // Clear the file input
        }
    }
});
</script>

<?= $this->endSection('content'); ?>