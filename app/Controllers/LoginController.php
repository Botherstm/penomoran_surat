<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DefaultPasswordModel;

class LoginController extends BaseController
{

    protected $userModel;
      protected $default_password;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->default_password = new DefaultPasswordModel();
    }
    public function index()
    {
        $siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
        // dd($siteKey);
        $ip  = $this->request->getIPAddress();

        // dd($ip);
        $cooldownTime = session()->get('cooldown_time') ?? 0;
        return view('login', [
            'validation' => \Config\Services::validation(),
            'key' => $siteKey,
            'cooldownTime' => $cooldownTime,
        ]);
    }

    public function login()
    {

        $loginAttempts = session()->get('login_attempts') ?? 0;
        $cooldownTime = session()->get('cooldown_time') ?? 0;

        
        if ($loginAttempts >= 3 && time() < $cooldownTime) {
            // Jika sudah melebihi batas percobaan dan masih dalam cooldown, tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('errors', 'Anda telah mencoba login terlalu banyak. Silakan coba lagi nanti.');
        }
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
            return redirect()->back()->withInput()->with('errors', 'Silakan verifikasi reCAPTCHA terlebih dahulu.');
        } else {
            session();
            $email = $this->request->getPost('email');
            $password = (string) $this->request->getPost('password');
            // Cari pengguna berdasarkan email
            $user = $this->userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                  $default = $this->default_password->getOne();
                // Periksa apakah password sesuai
                    if ($password == $default['password_default']) {
                        return view("gantiPassword", [
                            'email' => $email,
                        ]);
                    } else {
                        $userData = [
                            'user_id' => $user['id'],
                            'instansi_id' => $user['instansi_id'],
                            'bidang_id' => $user['bidang_id'],
                            'slug' => $user['slug'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'no_hp' => $user['no_hp'],
                            'gambar' => $user['gambar'],
                            'level' => $user['level'],
                        ];
                        // dd($userData);
                        session()->set($userData);
                        session()->remove(['login_attempts', 'cooldown_time']);
                        return redirect()->to(base_url('/'));
                }
            } else {
                $loginAttempts++;
                session()->set('login_attempts', $loginAttempts);
                if ($loginAttempts == 3) {
                    $cooldownDuration = 60; // cooldown selama 1 menit
                    $cooldownTime = time() + $cooldownDuration;
                    session()->set('cooldown_time', $cooldownTime);
                }
                elseif ($loginAttempts >= 4 && $loginAttempts < 6) {
                $cooldownDuration = 300; // cooldown selama 5 menit
                $cooldownTime = time() + $cooldownDuration;
                session()->set('cooldown_time', $cooldownTime);
                } elseif ($loginAttempts >= 6) {
                    // Blokir IP dan simpan ke database
                    // $this->blockIP($this->request->getIPAddress());
                    return redirect()->back()->withInput()->with('errors', 'IP Anda telah diblokir karena percobaan login yang berulang.');
                }
                return redirect()->back()->withInput()->with('errors', 'Invalid email or password');
            }
        }

    }

    public function logout()
    {
        // Hapus data pengguna dari session
        session()->remove(['user_id', 'instansi_id', 'bidang_id', 'slug', 'nip', 'name', 'email', 'no_hp', 'level']);
        return redirect()->to(base_url('/'));
    }

}