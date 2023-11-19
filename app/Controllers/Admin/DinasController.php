<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BidangModel;
use App\Models\DinasModel;
use Ramsey\Uuid\Uuid;

class DinasController extends BaseController
{

    protected $dinas;
    protected $bidang;
    public function __construct()
    {
        $this->dinas = new DinasModel();
        $this->bidang = new BidangModel();
    }
    public function index()
    {

        if (!session()->has('user_id')) {
           return redirect()->to(base_url('/login'));
        }
        if (session()->get('level') != 2) {
            // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        // $result =json_decode( $this->dinas->get_data());
        // foreach ($result->data as $dinas) {
        //     $dinas[$dinas['id']] = $this->dinas->getByBidangId($dinas['id']);
        // }
        // dd($result);

        $dinass = $this->dinas->getAll();
        foreach ($dinass as $dinas) {
            $dinasId = $dinas['id'];
            $bidangData = $this->bidang->getAllByInstansiId($dinasId);
            $bidangs[$dinasId] = $bidangData;
        }
        // dd($dinass,$bidangs);
        return view('admin/dinas/index', [
            'dinass' => $dinass,
            'active' => 'dinas',
        ]);
    }

    public function create()
    {   
        if (!session()->has('user_id')) {
           return redirect()->to(base_url('/login'));
        }
          if (session()->get('level') != 2) {
            // Jika level pengguna bukan 2 atau 3, lempar error Access Forbidden
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view('admin/dinas/create', [
            'active' => 'dinas',
        ]);
    }

    public function save()
    {
        // Validasi input data
        $rules = [
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
            'urutan' => 'required|integer',
        ];

        if ($this->validate($rules)) {
            $name = $this->request->getPost('name');
            $kode = $this->request->getPost('kode');
            $slug = $this->request->getPost('slug');
            $urutan = $this->request->getPost('urutan');

            // Data valid, simpan ke dalam database
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'name' => $name,
                'kode' => $kode,
                'slug' => $slug,
                'urutan' => $urutan,
            ];
            // dd($data);
            $this->dinas->insert($data);

            return redirect()->to(base_url('/admin/dinas'))->with('success', 'Data Dinas berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
        }

    }

    public function edit($slug)
    {
        $dinas = $this->dinas->getBySlug($slug);
        // dd($instansi);
        return view('admin/dinas/edit', [
            'active' => 'user',
            'dinas' => $dinas,
        ]);
    }

    public function update()
    {
        // Validasi input form
        $rules = [
            'name' => 'required',
            'kode' => 'required',
            'slug' => 'required',
            'urutan' => 'required',
        ];
        $id = $this->request->getPost('id');
        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $dinasData = [

                'name' => $this->request->getPost('name'),
                'kode' => $this->request->getPost('kode'),
                'slug' => $this->request->getPost('slug'),
                'urutan' => $this->request->getPost('urutan'),
            ];
            // dd($dinasData);
            // Simpan data pengguna ke dalam database
            $this->dinas->update($id, $dinasData);

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to(base_url('/admin/dinas'))->with('success', 'Data berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());

        }
    }

    public function delete($slug)
    {
        $data = $this->dinas->getBySlug($slug);
        $dinas = $data['id'];
        // dd($dinas);
        if ($dinas) {
            $this->dinas->delete($data['id']);
            return redirect()->to(base_url('admin/dinas'))->with('success', 'data deleted successfully.');
        } else {
            return redirect()->to(base_url('admin/dinas'))->with('error', 'data not found.');
        }
    }
}