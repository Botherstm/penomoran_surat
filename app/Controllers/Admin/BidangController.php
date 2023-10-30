<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use App\Models\KategoryModel;
use Ramsey\Uuid\Uuid;

class BidangController extends BaseController
{
    protected $bidang;
    protected $dinas;

    protected $kategori;
    public function __construct()
    {
        $this->bidang = new BidangModel();
        $this->dinas = new DinasModel();
        $this->kategori = new KategoryModel();
    }
    public function index($slug)
    {
        if (session()->get('level') != 1 && session()->get('level') != 2) {
            // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $instansi = $this->dinas->getBySlug($slug);
        $bidangs = $this->bidang->getAllByInstansiId($instansi['id']);
        return view('admin/bidang/index', [
            'bidangs' => $bidangs,
            'active' => 'bidang',
            'instansi' => $instansi,
        ]);
    }

    public function view1()
    {
        if (session()->get('level') != 1 && session()->get('level') != 2) {
            // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $instansi = $this->dinas->getById(session()->get('instansi_id'));

        $bidangs = $this->bidang->getAllByInstansiId(session()->get('instansi_id'));
        return view('admin/bidang/index', [
            'bidangs' => $bidangs,
            'active' => 'bidang',
            'instansi' => $instansi,
        ]);
    }

    public function create($slug)
    {
        $instansi = $this->dinas->getBySlug($slug);
        return view('admin/bidang/create', [
            'active' => 'bidang',
            'instansi' => $instansi,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $validationRules = [
            'instansi_id' => 'required',
            'kode' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }

        // Ambil data dari input form
        $name = $this->request->getPost('name');
        $instansi_id = $this->request->getPost('instansi_id');
        $kode = $this->request->getPost('kode');
        $slug = $this->request->getPost('slug');

        //perubahan data
        $uuid = Uuid::uuid4();
        $uuidString = $uuid->toString();

        $data = [
            'id' => $uuidString,
            'instansi_id' => $instansi_id,
            'kode' => $kode,
            'name' => $name,
            'slug' => $slug,
        ];

        $this->bidang->insert($data);
        $instansi = $this->dinas->getById($instansi_id);
        // dd($instansi['slug']);
        return redirect()->to(base_url('/admin/dinas/bidang/' . $instansi['slug']))->with('success', 'Data Bidang berhasil disimpan');
    }

    public function edit($slug)
    {
        $bidang = $this->bidang->getBySlug($slug);
        $instansi = $this->dinas->getAllById($bidang['instansi_id']);

        // dd($instansi);
        return view('admin/bidang/edit', [
            'active' => 'bidang',
            'bidang' => $bidang,
            'instansi' => $instansi['slug'],
        ]);
    }

    public function update($id)
    {
        // Validasi input form
        $rules = [
            'instansi_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        if ($this->validate($rules)) {
            $instansiId = $this->request->getPost('instansi_id');
            $instansi = $this->dinas->getAllById($instansiId);
            // dd($instansi);
            // Data pengguna yang akan disimpan
            $bidangData = [
                'instansi_id' => $instansiId,
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($bidangData);
            // Simpan data pengguna ke dalam database
            $this->bidang->update($id, $bidangData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to(base_url('/admin/dinas/bidang/' . $instansi['slug']))->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }

    public function delete($slug)
    {
        $data = $this->bidang->getBySlug($slug);
        $bidang = $this->bidang->find($data['id']);
        $instansis = $this->dinas->get_instansi_by_id($bidang['instansi_id']);
        $instansijson = json_encode($instansis);
        $instansi = json_decode($instansijson);
        // dd($bidang);
        if ($bidang) {
            $this->bidang->delete($data['id']);
            return redirect()->to(base_url('admin/dinas/bidang/' . $instansi->slug))->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to(base_url('admin/dinas/bidang/' . $instansi->slug))->with('error', 'data not found.');
        }
    }
}