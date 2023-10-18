<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\GenerateModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use App\Models\UrutanSuratModel;
use App\Models\UserModel;
use Mpdf\Mpdf;
use Ramsey\Uuid\Uuid;

class TerlewatController extends BaseController
{
    protected $user;
    protected $generate;
    protected $urutan;
    protected $bidang;
    protected $dinas;
    protected $perihal;
    protected $kategori;
    protected $subperihal;
    protected $detailsubperihal;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->generate = new GenerateModel();
        $this->urutan = new UrutanSuratModel();
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
        $this->detailsubperihal = new DetailSubPerihalModel();
    }


    public function index()
    {
        // $user = $this->user->getBySlug($slug);
        $data = $this->generate->getOneLatestByInstansiId(session()->get('instansi_id'))??[];
        if($data != null){
            if ($data['tanggal'] > date('Y-m-d')) {
            $tanggal = date('Y-m-d', strtotime('-1 day', strtotime($data['tanggal'])));
            }
            else{
                $tanggal = $data['tanggal'];
            }
        }else{
            $tanggal = [];
        }
        $generate = $this->generate->getAllByInstansi_id(session()->get('instansi_id'));
        //  dd($tanggal);
        $bidang = $this->bidang->getById(session()->get('bidang_id'));
        $dinas = $this->dinas->getById(session()->get('instansi_id'));
        $kategories = $this->kategori->getAll();
        // dd($bidang);
        return view('public/terlewat/index', [
            'kategories' => $kategories,
            'bidang' => $bidang,
            'dinas' => $dinas,
            'generate' => $generate,
            'tanggal' => $tanggal
        ]);
    }


    public function save()
    {


        // Validasi input data
        $rules = [
            'instansi' => 'required',
            'bidang' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
        ];

                //tanggal
        $tanggal = $this->request->getPost('tanggal');
        
        list($tahun, $bulan, $tanggal) = explode("-", $tanggal);
        $bulan_romawi = [
            'I', 'II', 'III', 'IV', 'V', 'VI',
            'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
        ];
        $bulan_romawi = $bulan_romawi[intval($bulan) - 1]; // -1 karena array dimulai dari 0
        $tahun_angka = intval($tahun);
        $date = $tahun . "-" . $bulan . "-" . $tanggal;
        $datas = $this->generate->getAllByTanggal($date);
        // dd($datas);
        $terbesarTerlewat = "00";
        $urutan_terkecil = PHP_INT_MAX;
        foreach ($datas as $data) {
            if ($data['terlewat'] != null) {
                $terlewat = $data['terlewat'];
                if ($terlewat > $terbesarTerlewat) {
                    $terbesarTerlewat = $terlewat;
                }
                $newTerlewat = sprintf('%02d', (int) $terbesarTerlewat + 1);
            }
            elseif ($data['terlewat'] == null){
                if($data > 1)
                {
                     $urutan = $data['urutan'];
                        if ($urutan < $urutan_terkecil) {
                            $urutan_terkecil = $urutan;
                        }
                    $newTerlewat = sprintf('%02d', (int) $terbesarTerlewat + 1);
                }
            }
        }
        // dd($terbesarTerlewat,$newTerlewat,$urutan_terkecil);

        // dd($this->request->getPost());
            $pdf = $this->request->getFile('pdf_upload');
            $newName = $pdf->getRandomName();
            $pdf->move(ROOTPATH . 'public/pdf', $newName);
       
        if ($this->validate($rules)) {
            $nomor = $this->request->getPost('nomor');
            $kategori = $this->kategori->getByKode($this->request->getPost('nomor')) ?? [];
            if ($kategori != null) {
                $data = $kategori;
            }
            else{
                $data = $this->perihal->getBykode($this->request->getPost('nomor'));
            }
            // dd($data);
            //dinas
            $dinas = $this->dinas->getById(session()->get('instansi_id'));

            //bidang
            $bidang = $this->bidang->getById(session()->get('bidang_id'));



            // dd($urutan_terkecil);
            $kode = $nomor ."/". $urutan_terkecil.".".$newTerlewat."/". $bidang['kode'] .".". $dinas['kode']."/".$bulan_romawi."/".$tahun_angka;
            // dd($kode);
            

            //id
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            
            $data = [
                'id' => $uuidString,
                'user_id' => session()->get('user_id'),
                'instansi_id' => session()->get('instansi_id'),
                'bidang_id' => session()->get('bidang_id'),
                'urutan' => $urutan_terkecil,
                'terlewat' => $newTerlewat,
                'pdf' => $newName,
                'perihal' => $data['name'],
                'nomor' => $kode,
                'tanggal' =>$this->request->getPost('tanggal'),
            ];
            // dd($data);
            $this->generate->insert($data);
            
            return redirect()->to('/public/riwayat/')->with('success', 'Berhasil Menggenerate Kode Surat.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }


    public function tentang()
    {
    
        return view('public/tentang', [

        ]);
    }

   public function generatePdf()
    {
        // Pastikan data yang dibutuhkan ada dalam permintaan POST
        $pdfContent = $this->request->getPost('pdfContent');
        $positionX = $this->request->getPost('positionX');
        $positionY = $this->request->getPost('positionY');

        if (!$pdfContent || !$positionX || !$positionY) {
            return response()->setStatusCode(400)->setJSON(['error' => 'Data is missing']);
        }

        $mpdf = new Mpdf();
        $mpdf->AddPage();
        $mpdf->WriteHTML('<div style="position: absolute; left: ' . $positionX . 'px; top: ' . $positionY . 'px;">' . $pdfContent . '</div');

        // Menghasilkan file PDF sebagai respons ke sisi klien
        $pdfData = $mpdf->Output('', 'S');
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="generated.pdf"')
            ->setBody($pdfData);
    }

}