<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserTokenModel;
use CodeIgniter\I18n\Time;
use DateTime;
use Ramsey\Uuid\Uuid;

class LupaPasswordController extends BaseController
{
    protected $userModel;
    protected $userToken;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userToken = new UserTokenModel();

    }
    public function index()
    {
        return view('/lupa');

    }
    private function _sendEmail()
    {

        $config = [
            'protocol' => 'smtp',
            'SMTPCrypto' => 'ssl',
            'SMTPHost' => 'smtp.googlemail.com',
            'SMTPUser' => 'e.nomor252@gmail.com',
            'SMTPPass' => 'jtaq zepq nmiy iluu',
            'SMTPPort' => 465,
            'mailType' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setNewLine("\r\n");
        $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
        $email->setTo('yonimheswara@gmail.com');
        $email->setSubject('Reset password');
        $email->setMessage('Email content goes here');

        if ($email->send()) {
            echo 'Email telah berhasil dikirim';
        } else {
            echo 'Email gagal dikirim. Pesan kesalahan: ' . $email->printDebugger();
            die;
        }

    }
    public function LupaPassword()
    {
        $userEmail = $this->request->getPost('email');
        $user = $this->userModel->where('email', $userEmail)->first();
        $userToken = $this->userToken->where('email', $userEmail)->first();

        if ($user) {
            // dd($user);
            if ($userToken['created_at']) {
                $createdTime = Time::parse($userToken['created_at']);
                $currentTime = new DateTime();

                $difference = $currentTime->getTimestamp() - $createdTime->getTimestamp();
                if ($difference < 86400) {
                    // dd($user);
                    return redirect()->back()->with('error', 'kami sudah mengirimkan verivikasi silahkan cek Email Anda');
                }
            }

            $token = base64_decode(random_bytes(32));
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $user_token = [
                'id' => $uuidString,
                'email' => $userEmail,
                'token' => $token,
                'created_at' => Time::now(),
            ];
            dd($user_token);
            $this->userToken->insert($user_token);
            return redirect()->back()->with('success', 'token tertambah');

        } else {
            return redirect()->back()->with('error', 'email tidak terdaftar');
        }

    }

}
