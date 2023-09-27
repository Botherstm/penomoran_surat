<?php

namespace App\Controllers\auth;
use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Email\Email;

class Register extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {

        return view('register',[
            'validation' => \Config\Services::validation(),
        ]);
    }
    public function store()
{
    if (!$this->validate([
        'name' => [
            'rules' => 'required|is_unique[users.name]',
            'errors' => [
                'required' => '{field} harus diisi',
                'is_unique' => '{field} sudah terdaftar'
            ]
        ],
        'email' => [
            'rules' => 'required|is_unique[users.email]',
            'errors' => [
                'required' => '{field} harus diisi',
                'is_unique' => '{field} sudah terdaftar'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => '{field} harus diisi',
                'min_length' => '{field} minimal 8 karakter'
            ]
        ]
    ])) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $this->userModel->save([
        'name' => $this->request->getVar('name'),
        'email' => $this->request->getVar('email'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
    ]);

    return redirect()->to('/')->with('success', 'Registration Success. Please Login');
}


    
    public function register()
    {
        $name = $this->request->getPost('name');
        $emailTo = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $token = bin2hex(random_bytes(32));

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $data = [
            'name' => $name,
            'email' => $emailTo,
            'password' => $hashedPassword,
        ];
        // Kirim email verifikasi dengan tautan yang berisi token verifikasi
        $verificationLink = base_url('verify/' . $token);
        $emailConfig = [
            'protocol' => 'smtp', // Ganti dengan protokol email yang sesuai
            'SMTPHost' => 'smtp.gmail.com', // Ganti dengan host SMTP yang sesuai
            'SMTPPort' => '465', // Ganti dengan port SMTP yang sesuai
            'SMTPUser' => 'album1122334455@gmail.com', // Ganti dengan username SMTP yang sesuai
            'SMTPPass' => 'dldrzxolpuljnrdh', // Ganti dengan password SMTP yang sesuai
            'mailType' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $email = new Email($emailConfig);
        $email->setFrom('album1122334455@gmail.com', 'My Album'); // Ganti dengan alamat email dan nama pengirim yang sesuai
        $email->setTo($emailTo); // Menggunakan variabel $emailTo sebagai alamat email tujuan
        $email->setSubject('Verifikasi Email');
        $email->setMessage('Silakan klik tautan berikut untuk verifikasi email Anda: ' . $verificationLink);

        if ($email->send()) {
            $this->userModel->insert($data);
            // Redirect to login page or do something else
            return redirect()->to('/login')->with('success', 'Register Berhasil Silahkan Login');
        } else {
            // Handle email sending error
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim email verifikasi. Silakan coba lagi.');
        }
    }
}