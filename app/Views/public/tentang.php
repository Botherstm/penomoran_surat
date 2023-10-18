<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag-and-Drop PDF with Text</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0px 0px 5px #888;
        padding: 20px;
        text-align: center;
    }

    .pdf-container {
        position: relative;
    }

    .pdf-preview {
        width: 100%;
        max-height: 350px;
    }

    .draggable {
        background-color: #3498db;
        color: #ffffff;
        text-align: center;
        line-height: 30px;
        width: auto;
        height: auto;
        position: absolute;
        cursor: move;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        background-color: #3498db;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .generate-button {
        background-color: #3498db;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="pdf-container">
            <div class="pdf-preview">
                <div style="margin: 0 auto; padding-bottom: 20px; width: 75%;">
                    <div class="preview-container" style="display: inline;">
                        <!-- Preview of the uploaded PDF will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="draggable" id="textElement">Drag me!</div>
        </div>
        <form id="uploadForm" enctype="multipart/form-data">
            <label for="inputGroupFile01" class="custom-file-label">
                Choose PDF file
            </label>
            <input type="file" class="custom-file-input" id="inputGroupFile01" accept=".pdf">
            <button type="button" class="generate-button" id="generateButton">Generate PDF</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    document.getElementById("inputGroupFile01").addEventListener("change", function(event) {
        const fileInput = event.target;
        const previewContainer = document.querySelector(".preview-container");
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            if (file.type === "application/pdf") {
                previewContainer.innerHTML = "";
                const pdfObject = document.createElement("object");
                pdfObject.data = URL.createObjectURL(file);
                pdfObject.type = "application/pdf";
                pdfObject.style.width = "100%";
                pdfObject.style.height = "1000px"; // Adjust the height as needed
                previewContainer.appendChild(pdfObject);
            } else {
                alert("Please upload a PDF file.");
                fileInput.value = "";
            }
        }
    });

    var isDragging = false;
    var offsetX = 0;
    var offsetY = 0;

    $(".draggable").on("mousedown", function(e) {
        isDragging = true;
        offsetX = e.clientX - this.getBoundingClientRect().left;
        offsetY = e.clientY - this.getBoundingClientRect().top;
    });

    $(document).on("mousemove", function(e) {
        if (isDragging) {
            var x = e.clientX - offsetX;
            var y = e.clientY - offsetY;
            $(".draggable").css({
                left: x,
                top: y
            });
        }
    });

    $(document).on("mouseup", function() {
        isDragging = false;
    });

    $("#generateButton").click(function() {
        // Ambil posisi elemen yang dapat di-drag
        var textElement = document.getElementById("textElement");
        var position = {
            left: textElement.style.left,
            top: textElement.style.top
        };
        // Kirim data posisi dan PDF ke server dengan AJAX
        var formData = new FormData();
        var pdfFile = document.getElementById("inputGroupFile01").files[0];
        formData.append("pdfFile", pdfFile);
        formData.append("position", JSON.stringify(position));
        $.ajax({
            url: "server.php", // Ganti dengan URL server Anda
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Server mengembalikan URL file PDF yang dihasilkan
                window.location.href = response;
            }
        });
    });
    </script>
</body>

</html>