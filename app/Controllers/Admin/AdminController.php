<?php

namespace App\Controllers\Admin; // Sesuaikan namespace dengan struktur folder
use App\Controllers\BaseController;

class AdminController extends BaseController
{

    public function index(): string
    {
        if (!session()->has('user_id')) {
            $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
            // dd($siteKey);
            return view('login', [
                'validation' => \Config\Services::validation(),
                'key' => $siteKey,
            ]);
        }
        if (session()->get('level') != 1 && session()->get('level') != 2) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        return view('admin/index', [
            'active' => 'admin',
        ]);

    }

    public function user()
    {
        return view('public/index');
    }
}
