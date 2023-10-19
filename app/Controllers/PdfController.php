<?php

namespace App\Controllers;

use setasign\Fpdi\Fpdi;
// Menggunakan setasign\Fpdi\Fpdi

class PdfController extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function upload()
    {
        $uploadedFile = $this->request->getFile('pdf_file');

        if ($uploadedFile->getClientMimeType() === 'application/pdf') {
            // Simpan file PDF di direktori sementara
            $uploadedFile->move(ROOTPATH . 'public/assets/pdf', $uploadedFile->getName());

            // Ambil data koordinat dan teks dari AJAX
            $x = $this->request->getPost('x');
            $y = $this->request->getPost('y');
            $text = $this->request->getPost('text');

            // Buat objek FPDI
            $pdf = new Fpdi();

            // Tambahkan halaman dari file PDF yang diunggah
            $pdf->setSourceFile(ROOTPATH . 'public/assets/pdf/' . $uploadedFile->getName());
            $tplId = $pdf->importPage(1); // Import halaman pertama

            // Tambahkan halaman PDF yang diimpor ke dokumen baru
            $pdf->AddPage();
            $pdf->useTemplate($tplId);

            // Tambahkan teks ke PDF sesuai koordinat yang diberikan
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($x, $y);
            $pdf->Cell(0, 10, $text, 0, 1);

            // Simpan PDF yang telah diperbarui
            $outputPath = ROOTPATH . 'public/assets/pdf/' . 'modified_' . $uploadedFile->getName();
            $pdf->Output($outputPath, 'F');

            // Redirect ke halaman tampilan PDF
            return redirect()->to(site_url('/pdf/view/' . 'modified_' . $uploadedFile->getName()));
        } else {
            return redirect()->to(site_url('/'))->with('error', 'File yang diunggah bukan PDF.');
        }
    }

    public function view($filename)
    {
        $data = [
            'filename' => $filename,
        ];

        return view('view', $data);
    }
}
