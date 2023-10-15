<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DinasModel;
use App\Models\UrutanSuratModel;
use Ramsey\Uuid\Uuid;

class UrutanSuratController extends BaseController
{

    protected $dinas;

    protected $urutan;
    public function __construct()
    {

        $this->dinas = new DinasModel();
        $this->urutan = new UrutanSuratModel();
    }
    public function index($ket_uorg)
    {
        
        return view('admin/urutansurat/index', [
            'active' => 'urutansurat',
            'instansi'=> $ket_uorg
        ]);
    }

    public function create($ket_uorg)
    {
        $instansis = $this->dinas->getByKet_org($ket_uorg);
        $instansijson = json_encode($instansis);
        $instansi = json_decode($instansijson);
        // dd($instansi);
        return view('admin/urutansurat/create', [
            'active' => 'urutansurat',
             'instansi' => $instansi,
        ]);
    }


    public function save()
    {
        // Validasi input data
        $rules = [
            'urutan' => 'required',
            'instansi_id' => 'required',
        ];

        if ($this->validate($rules)) {
            $urutan = $this->request->getPost('urutan');
            $instansi_id = $this->request->getPost('instansi_id');
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $data = [
                'id' => $uuidString,
                'instansi_id' => $instansi_id,
                'urutan' => $urutan,
            ];
    // dd($data);
            $this->urutan->insert($data);

            return redirect()->to('/admin/dinas')->with('success', 'Data UrutanSurat berhasil disimpan.');
        } else {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->with('error', 'periksa apakah data sudah terisi dengan benar');
        }
    }


    public function edit($ket_uorg)
    {
        $instansis = $this->dinas->get_instansi_by_id(session()->get('instansi_id'));
        $instansijson = json_encode($instansis);
        $instansi = json_decode($instansijson);
        $urutan = $this->urutan->getOneByInstansiId($instansi->id_instansi);
        // dd($instansi,$urutan);
        return view('admin/urutansurat/edit', [
            'active' => 'user',
            'urutan' => $urutan,
        ]);
    }


    public function update($id)
    {
        // Validasi input form
        $rules = [
          'urutan' => 'required',
        ];

        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $urutan = [
                'urutan' => $this->request->getPost('urutan'),
            ];
            // dd($urutan);
            // Simpan data pengguna ke dalam database
            $this->urutan->update($id, $urutan);
            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->to('/admin/dinas')->with('success', 'Data Urutan berhasil Di Update !');
        } else {
            // Jika validasi gagal, kembali ke formulir pendaftaran dengan pesan kesalahan dan input sebelumnya
            return redirect()->back()
                ->with('validationErrors', 'periksa apakah data sudah terisi dengan benar');
        }
    }

    // public function delete($slug)
    // {
    //     // Cari data album berdasarkan ID
    //     $data = $this->Kategory->getBySlug($slug);
    //     $kategori = $this->Kategory->find($data['id']);
    //     // dd($kategori);
    //     if ($kategori) {
    //       $this->Kategory->delete($data['id']);
    //         return redirect()->to('admin/kategori')->with('success', 'data deleted successfully.');
    //     } else {
    //         return redirect()->to('admin/kategori')->with('error', 'data not found.');
    //     }
    // }


}