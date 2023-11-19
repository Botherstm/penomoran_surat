<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DefaultPasswordModel;
use App\Models\UserModel;
use Ramsey\Uuid\Uuid;

class DefaultController extends BaseController
{
   
      protected $default_password;
    protected $user;

    public function __construct()
    {
        $this->default_password = new DefaultPasswordModel();
        $this->user = new UserModel;
    }

   
      public function index()
    {
        if (!session()->has('user_id')) {
           return redirect()->to(base_url('/login'));
        }
        if (session()->get('level') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $default = $this->default_password->getOne();
        // dd($default);
        return view('admin/defaultpassword/index', [
            'default' => $default,
            'active' => 'defaultpassword',
        ]);
    }
    public function update()
    {
        if (!session()->has('user_id')) {
           return redirect()->to(base_url('/login'));
        }
        if (session()->get('level') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $rules = [
            'password' => 'required',
        ];
        $default = $this->default_password->getOne();
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');

        if ($this->validate($rules)) {
            // Data default password yang akan disimpan
            $defaultData = [
                'password_default' => $password,
            ];
            $this->default_password->update($id, $defaultData);

            // Perbarui password pengguna yang memiliki password default yang sama
            $usersDenganPasswordDefaultSama = $this->user->getUsersByDefaultPassword($default['password_default']);
            foreach ($usersDenganPasswordDefaultSama as $user) {
                $dataPengguna = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];
                $this->user->update($user['id'], $dataPengguna);
            }

            return redirect()->back()->with('success', 'Password Default berhasil Di Update !');
        } else {
            return redirect()->back()->withInput()->with('errors', service('validation')->getErrors());
        }
    }

}