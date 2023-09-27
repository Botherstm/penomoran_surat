<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;

class PdfController extends BaseController
{
    public function index()
    {
        return view('admin/index'); // Sesuaikan dengan struktur folder view yang benar
    }

    // Tambahkan fungsi-fungsi lain yang diperlukan untuk controller ini
}