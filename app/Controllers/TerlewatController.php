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


    public function index($slug)
    {
        $user = $this->user->getBySlug($slug);
        $generate = $this->generate->getAllByInstansi_id(session()->get('instansi_id'));
        //  dd($generate,$user);
        $bidang = $this->bidang->getById(session()->get('bidang_id'));
        $dinas = $this->dinas->getById(session()->get('instansi_id'));
        $kategories = $this->kategori->getAll();
        // dd($bidang);
        return view('public/terlewat/index', [
            'kategories' => $kategories,
            'bidang' => $bidang,
            'dinas' => $dinas,
            'generate' => $generate
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

        // dd($this->request->getPost(),$newName);
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

            //pdf
            
            // $pdf->move(ROOTPATH . 'public/pdf', $newName);
            
            //tanggal
            $tanggal = $this->request->getPost('tanggal');
            list($tahun, $bulan, $tanggal) = explode("-", $tanggal);
            $bulan_romawi = [
                'I', 'II', 'III', 'IV', 'V', 'VI',
                'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
            ];
            $bulan_romawi = $bulan_romawi[intval($bulan) - 1]; // -1 karena array dimulai dari 0
            $tahun_angka = intval($tahun);
            // dd($bulan_romawi,$tahun_angka);

    
            //urutan
            $urutan = $this->urutan->getOneByInstansiId(session()->get('instansi_id'));
            $urutanPlusOne = $urutan['urutan'] + 1; // Menambahkan 1 ke nilai yang ada
            $urutanData = [
                'urutan' => $urutanPlusOne,
            ];
            // dd($urutanData);
            $kode = $nomor ."/". $urutan['urutan'] ."/". $bidang['kode'] .".". $dinas['kode']."/".$bulan_romawi."/".$tahun_angka;
            // dd($kode);
            

            //id
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();

            
            $data = [
                'id' => $uuidString,
                'user_id' => session()->get('user_id'),
                'instansi_id' => session()->get('instansi_id'),
                'bidang_id' => session()->get('bidang_id'),
                'urutan' => $urutan['urutan'],
                'pdf' => $newName,
                'perihal' => $data['name'],
                'nomor' => $kode,
                'tanggal' =>$this->request->getPost('tanggal'),
            ];
            // dd($data);
            
            $this->urutan->update($urutan['id'], $urutanData);
            $this->generate->insert($data);
            
            return redirect()->to('/')->with('success', 'Berhasil Menggenerate Kode Surat.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }
}