<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
        // dd($siteKey);
        return view('login', [
            'validation' => \Config\Services::validation(),
            'key' => $siteKey,
        ]);
    }

    public function login()
    {

        $recaptchaSecretKey = '6Ldc6pQoAAAAAOgAa4PU6aT8GwfhXH61llUBzIEy';
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        $recaptchaVerificationUrl = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaResponse,
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $recaptchaResult = file_get_contents($recaptchaVerificationUrl, false, $context);
        $recaptchaResult = json_decode($recaptchaResult);

        if (!$recaptchaResult->success) {
            // ReCAPTCHA tidak berhasil, tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Silakan verifikasi reCAPTCHA terlebih dahulu.');
        } else {
            session();
            $email = $this->request->getPost('email');
            $password = (string) $this->request->getPost('password');
            $recaptcha = $this->request->getPost('h-captcha');

            // Cari pengguna berdasarkan email
            $user = $this->userModel->where('email', $email)->first();

            if ($user) {
                // Periksa apakah password sesuai
                if (password_verify($password, $user['password'])) {
                    $userData = [
                        'user_id' => $user['id'],
                        'instansi_id' => $user['instansi_id'],
                        'bidang_id' => $user['bidang_id'],
                        'slug' => $user['slug'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'no_hp' => $user['no_hp'],
                        'level' => $user['level'],
                    ];
                    // dd($userData);
                    session()->set($userData);

                    return redirect()->to('/');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Invalid email or password');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password');
            }
        }

    }

    public function logout()
    {
        // Hapus data pengguna dari session
        session()->remove(['user_id', 'instansi_id', 'bidang_id', 'slug', 'nip', 'name', 'email', 'no_hp', 'level']);
        return redirect()->to('/');
    }
}
