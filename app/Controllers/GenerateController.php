<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\DetailSubPerihal;
use App\Models\BidangModel;
use App\Models\DetailSubPerihalModel;
use App\Models\DinasModel;
use App\Models\GenerateModel;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use App\Models\UrutanSuratModel;
use Ramsey\Uuid\Uuid;

class GenerateController extends BaseController
{
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
        session();
        if (!session()->has('user_id')) {
            $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
            // dd($siteKey);
            return view('login', [
                'validation' => \Config\Services::validation(),
                'key' => $siteKey,
            ]);
        }
        $kategories = $this->kategori->getAll();
        return view(
            'generate',
            [
                'kategories' => $kategories,
            ]
        );
    }

    public function save()
    {
        $rules = [
            'instansi' => 'required',
            'bidang' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
        ];
        $tanggal = $this->request->getPost('tanggal');

        $tanggalsuratterakhir = $this->generate->getOneLatestByInstansiId(session()->get('instansi_id'));
        // dd($tanggal,$tanggalsuratterakhir['tanggal']);

        //cek apakah tanggal yang di inputkan lebih atau sama dengan tanggal terakhir di surat
        if ($tanggal >= $tanggalsuratterakhir['tanggal']) {

            if ($this->validate($rules)) {
                $nomor = $this->request->getPost('nomor');
                $kategori = $this->kategori->getByKode($this->request->getPost('nomor')) ?? [];

                //cari nama perihal
                if ($kategori != null) {
                    $data = $kategori;
                } else {
                    $data = $this->perihal->getBykode($this->request->getPost('nomor'));
                }

                // dd($data);
                //dinas
                $dinas = $this->dinas->getById(session()->get('instansi_id'));

                //bidang
                $bidang = $this->bidang->getById(session()->get('bidang_id'));

                //tanggal

                list($tahun, $bulan, $tanggal) = explode("-", $tanggal);
                $bulan_romawi = [
                    'I',
                    'II',
                    'III',
                    'IV',
                    'V',
                    'VI',
                    'VII',
                    'VIII',
                    'IX',
                    'X',
                    'XI',
                    'XII',
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
                $kode = $nomor . "/" . $urutan['urutan'] . "/" . $bidang['kode'] . "." . $dinas['kode'] . "/" . $bulan_romawi . "/" . $tahun_angka;
                // dd($kode);

                //slug
                $mentahan = $nomor . "/" . $urutan['urutan'] . "/" . $bidang['kode'] . "." . $dinas['kode'] . "/" . $bulan_romawi . "/" . $tahun_angka;
                $slug = preg_replace('/[^a-z0-9-]/', '-', strtolower($mentahan));
                $slug = str_replace(' ', '-', $slug);
                $slug = preg_replace('/-+/', '-', $slug);

                //id
                $uuid = Uuid::uuid4();
                $uuidString = $uuid->toString();

                $data = [
                    'id' => $uuidString,
                    'user_id' => session()->get('user_id'),
                    'instansi_id' => session()->get('instansi_id'),
                    'bidang_id' => session()->get('bidang_id'),
                    'urutan' => $urutan['urutan'],
                    'slug' => $slug,
                    'perihal' => $data['name'],
                    'nomor' => $kode,
                    'tanggal' => $this->request->getPost('tanggal'),
                ];
                // dd($data);
                $this->urutan->update($urutan['id'], $urutanData);
                $this->generate->insert($data);

                return redirect()->to('/')->with('success', 'Berhasil Menggenerate Kode Surat.');
            } else {
                // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
                return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
            }

        } else {

            list($tahun, $bulan, $tanggal) = explode("-", $tanggal);
            $bulan_romawi = [
                'I',
                'II',
                'III',
                'IV',
                'V',
                'VI',
                'VII',
                'VIII',
                'IX',
                'X',
                'XI',
                'XII',
            ];
            $bulan_romawi = $bulan_romawi[intval($bulan) - 1]; // -1 karena array dimulai dari 0
            $tahun_angka = intval($tahun);
            $date = $tahun . "-" . $bulan . "-" . $tanggal;
            // dd($date);
            $datas = $this->generate->getOneBeforeTanggal($date);

            // dd($datas);
            $databanyak = $this->generate->getAllByTanggal($datas['tanggal']);
            $dataurutanterkecil = $this->generate->getOneByTanggal($datas['tanggal']);
            $terbesarTerlewat = "00";
            $urutan_terkecil = PHP_INT_MAX;

            foreach ($databanyak as $data) {
                if ($datas['terlewat'] == null) {
                    if ($datas > 1) {
                        $urutan = $data['urutan'];
                        if ($urutan < $urutan_terkecil) {
                            $urutan_terkecil = $urutan;
                        }
                        $newTerlewat = sprintf('%02d', (int) $terbesarTerlewat + 1);
                    }
                    // } else {

                    // }
                } elseif ($datas['terlewat'] != null) {
                    $terlewat = $data['terlewat'];
                    $urutan_terkecil = $data['urutan'];

                    if ($terlewat > $terbesarTerlewat) {
                        $terbesarTerlewat = $terlewat;
                        $urutan_terkecil = $data['urutan'];

                    }
                    $newTerlewat = sprintf('%02d', (int) $terbesarTerlewat + 1);
                }

                // dd($terbesarTerlewat, $newTerlewat, $urutan_terkecil, $datas, $databanyak);

                if ($this->validate($rules)) {
                    $nomor = $this->request->getPost('nomor');
                    $kategori = $this->kategori->getByKode($this->request->getPost('nomor')) ?? [];
                    if ($kategori != null) {
                        $data = $kategori;
                    } else {
                        $data = $this->perihal->getBykode($this->request->getPost('nomor'));
                    }
                    // dd($data);
                    //dinas
                    $dinas = $this->dinas->getById(session()->get('instansi_id'));

                    //bidang
                    $bidang = $this->bidang->getById(session()->get('bidang_id'));

                    // dd($urutan_terkecil);
                    $kode = $nomor . "/" . $urutan_terkecil . "." . $newTerlewat . "/" . $bidang['kode'] . "." . $dinas['kode'] . "/" . $bulan_romawi . "/" . $tahun_angka;
                    // dd($kode);

                    //slug
                    $mentahan = $nomor . "/" . $urutan_terkecil . "." . $newTerlewat . "/" . $bidang['kode'] . "." . $dinas['kode'] . "/" . $bulan_romawi . "/" . $tahun_angka;
                    $slug = preg_replace('/[^a-z0-9-]/', '-', strtolower($mentahan));
                    $slug = str_replace(' ', '-', $slug);
                    $slug = preg_replace('/-+/', '-', $slug);

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
                        'slug' => $slug,
                        'perihal' => $data['name'],
                        'nomor' => $kode,
                        'tanggal' => $this->request->getPost('tanggal'),
                    ];
                    // dd($data);
                    $this->generate->insert($data);

                    return redirect()->to('/')->with('success', 'Berhasil Menggenerate Kode Surat.');
                } else {
                    // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
                    return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
                }
            }
        }
    }

    public function getPerihalByCategory($kategori_id)
    {
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $kategories = $this->kategori->getKategoriByid($kategori_id);
        $perihals = $this->perihal->getByKategori_id($kategories['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($perihals as $perihal) {
            $response[] = [
                'id' => $perihal['id'],
                'name' => $perihal['name'],
                'kode' => $perihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }
    public function getSubPerihalByPerihal($perihal_slug)
    {
        // Query database untuk mengambil data "Sub Perihal" berdasarkan perihal
        // Gantilah dengan logika pengambilan data sesuai dengan aplikasi Anda
        $perihals = $this->perihal->getBykode($perihal_slug);
        $subperihals = $this->subperihal->getAllByPerihalId($perihals['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($subperihals as $subperihal) {
            $response[] = [
                'id' => $subperihal['id'],
                'name' => $subperihal['name'],
                'kode' => $subperihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }

    public function getdetailSubPerihalByPerihal($subperihal_id)
    {
        $subperihals = $this->subperihal->getByKode($subperihal_id);
        $detailsubperihals = $this->detailsubperihal->getAllBySubPerihalId($subperihals['id']);

        // Ubah data menjadi format JSON
        $response = [];
        foreach ($detailsubperihals as $detailsubperihal) {
            $response[] = [
                'id' => $detailsubperihal['id'],
                'name' => $detailsubperihal['name'],
                'kode' => $detailsubperihal['kode'],
            ];
        }

        return $this->response->setJSON($response);
    }

}