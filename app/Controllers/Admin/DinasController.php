<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder



use setasign\Fpdi\Fpdi;
use App\Controllers\BaseController;
use App\Models\DinasModel;

class DinasController extends BaseController
{
    protected $dinas;
    public function __construct(){
        $this->dinas = new DinasModel();
    }
    
    public function index()
    {
        $dinas = $this->dinas->getAll();
      
        // dd($dinas);
        return view('admin/dinas/index',[
            'dinas' => $dinas,
            'active'=>'dinas'
        ]); // Sesuaikan dengan struktur folder view yang benar
    }

    public function create()
    {
        $dinas = $this->dinas->getAll();
        return view('admin/dinas/create', [
            'active' => 'dinas',
            'dinas' => $dinas,
        ]);
    }

    public function save()
    {
        $rules = [
            'name' => 'required',
        ];

        if ($this->validate($rules)) {
            // Generate unique 11-digit ID
            $uniqueId = $this->generateUniqueId();

            $data = [
                'id' => $uniqueId,
                'name' => $this->request->getPost('name'),
            ];

            $this->dinas->insert($data);

            return redirect()->to('/admin/dinas')->with('success', 'Data dinas berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    private function generateUniqueId()
    {
        $uuid = null;
        do {
            // Generate UUID (Version 4)
            $uuid = sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff)
            );
        } while ($this->dinas->where('id', $uuid)->countAllResults() > 0);

        return $uuid;
    }

    // Tambahkan fungsi-fungsi lain yang diperlukan untuk controller ini
}