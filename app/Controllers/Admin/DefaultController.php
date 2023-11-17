<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DefaultPasswordModel;
use Ramsey\Uuid\Uuid;

class DefaultController extends BaseController
{
   
      protected $default_password;

    public function __construct()
    {
        $this->default_password = new DefaultPasswordModel();
    }

   
      public function index()
    {
        $default = $this->default_password->getOne();
        // dd($default);
        return view('admin/defaultpassword/index', [
            'default' => $default,
            'active' => 'defaultpassword',
        ]);
    }

        public function update()
    {
        $rules = [
            'password' => 'required',
        ];
        $id = $this->request->getPost('id');
        // dd($id);
        if ($this->validate($rules)) {
            // Data pengguna yang akan disimpan
            $Data = [
                'password_default' => $this->request->getPost('password'),
            ];
            $this->default_password->update($id, $Data);
            return redirect()->back()->with('success', 'Password Default berhasil Di Update !');
        } else {
            return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
        }
    }
}