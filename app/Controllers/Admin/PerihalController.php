<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;
use App\Models\KategoryModel;
use App\Models\PerihalModel;
use App\Models\SubPerihalModel;
use Ramsey\Uuid\Uuid;

class PerihalController extends BaseController
{

    protected $Kategory;
    protected $perihal;
    protected $subperihal;
    public function __construct()
    {
        $this->Kategory = new KategoryModel();
        $this->perihal = new PerihalModel();
        $this->subperihal = new SubPerihalModel();
    }
    public function index($slug)
    {
        //        if (session()->get('level') != 2 && session()->get('level') != 3) {
        //     // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $kat = $this->Kategory->getBySlug($slug);
        $kategori = $this->perihal->getOneByKategoriId($kat['id']);
        $perihals = $this->perihal->getByKategori_id($kat['id']);

        // Anda juga perlu mendapatkan data sub perihal berdasarkan perihal id di sini
        $subPerihals = [];
        foreach ($perihals as $perihal) {
            $perihalId = $perihal['id'];
            $subPerihalData = $this->subperihal->getAllByPerihalId($perihalId);
            $subPerihals[$perihalId] = $subPerihalData;
        }
        // dd($subPerihals);
        return view('admin/perihal/index', [
            'active' => 'perihal',
            'perihals' => $perihals,
            'kategori' => $kategori,
            'subPerihals' => $subPerihals,
        ]);

    }

    public function create($slug)
    {
        $kat = $this->Kategory->getBySlug($slug);
        //  dd($kat);
        return view('admin/perihal/create', [
            'active' => 'perihal',
            'kategori' => $kat,
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'detail_id' => 'required',
            'kode' => 'required',
            'name' => 'required',
        ];

        if ($this->validate($rules)) {
            $detail_id = $this->request->getPost('detail_id');
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            $slug = $this->request->getPost('slug');
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'detail_id' => $detail_id,
                'kode' => $kode,
                'name' => $name,
                'slug' => $slug,
            ];
            // dd($data);
            $this->perihal->insert($data);
            $kategori = $this->Kategory->getById($detail_id);
            return redirect()->to(base_url('/admin/kategori/perihal/' . $kategori['slug']))->with('success', 'Data Kategory berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function edit($slug)
    {
        $perihal = $this->perihal->getBySlug($slug);
        $kategori = $this->Kategory->getById($perihal['detail_id']);
        // dd($kategori);
        return view('admin/perihal/edit', [
            'active' => 'user',
            'perihal' => $perihal,
            'kategori' => $kategori,
        ]);
    }

    public function update($id)
    {
        // Validasi input form
        $rules = [
            'detail_id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
        ];

        $validation = \Config\Services::validation(); // Mendapatkan instance validasi

        if ($this->validate($rules)) {
            $kategori = $this->request->getPost('detail_id');
            $data = $this->Kategory->getById($kategori);
            // Data pengguna yang akan disimpan
            $perihalData = [
                'detail_id' => $kategori,
                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
            ];
            // dd($perihalData);
            // Simpan data pengguna ke dalam database
            $this->perihal->update($id, $perihalData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to(base_url('/admin/kategori/perihal/' . $data['slug']))->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->withInput()
                ->with('validationErrors', $validation->getErrors());
        }
    }

    public function delete($slug)
    {
        $data = $this->perihal->getBySlug($slug);
        $perihal = $this->perihal->find($data['id']);
        $kategori = $this->Kategory->getById($perihal['detail_id']);
        // dd($perihal);
        if ($perihal) {
            $this->perihal->delete($data['id']);
            return redirect()->to(base_url('admin/kategori/perihal/' . $kategori['slug']))->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to(base_url('admin/kategori/perihal/' . $kategori['slug']))->with('error', 'data not found.');
        }
    }

}
