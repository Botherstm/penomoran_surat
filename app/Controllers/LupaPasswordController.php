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
        return view('/gakdipakai/lupa');

    }

    public function lupapw()
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

        $userEmail = $this->request->getPost('email');
        $user = $this->userModel->where('email', $userEmail)->first();
        // dd($user);
        $userToken = $this->userToken->where('email', $userEmail)->first();
        if ($user) {
            // dd($user);
            if ($userToken) {
                $createdTime = Time::parse($userToken['created_at']);
                $currentTime = new DateTime();
                $difference = $currentTime->getTimestamp() - $createdTime->getTimestamp();
                if ($difference < 86400) {
                    // dd($user);
                    return redirect()->back()->with('error', 'kami sudah mengirimkan verivikasi silahkan cek Email Anda');
                } else {

                    $token = base64_encode(random_bytes(32));
                    $uuid = Uuid::uuid4();
                    $uuidString = $uuid->toString();

                    $email = \Config\Services::email();
                    $email->initialize($config);
                    $email->setNewLine("\r\n");

                    $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
// dd($userEmail);
                    $email->setTo($userEmail);
                    $email->setSubject('Reset password');
                    $email->setMessage('<p style="text-align:center;">Click the button below to reset your password:</p><p style="text-align:center;">Your email: ' . $userEmail . '</p><p style="text-align:center;"><a href="' . base_url('resetpassword?&email=' . $userEmail . '&token=' . urlencode($token)) . '"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">Reset Password</button></a></p>');

                    $user_token = [
                        'id' => $uuidString,
                        'email' => $userEmail,
                        'token' => $token,
                        'created_at' => Time::now(),
                    ];

                    if ($email->send()) {
                        $this->userToken->insert($user_token);

                        return redirect()->back()->with('success', 'Email Berhasil dikirim');

                    } else {
                        return redirect()->back()->with('error', 'tidak dapat mengrim email');

                    }

                }

            }

            $token = base64_encode(random_bytes(32));
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();

            $email = \Config\Services::email();
            $email->initialize($config);
            $email->setNewLine("\r\n");

            $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
            // dd($userEmail);
            $email->setTo($userEmail);
            $email->setSubject('Reset password');
            $email->setMessage('<p style="text-align:center;">Click the button below to reset your password:</p><p style="text-align:center;">Your email: ' . $userEmail . '</p><p style="text-align:center;"><a href="' . base_url('resetpassword?&email=' . $userEmail . '&token=' . urlencode($token)) . '"><button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-align: center; display: inline-block; font-size: 16px; margin: 10px auto; cursor: pointer;">Reset Password</button></a></p>');

            $user_token = [
                'id' => $uuidString,
                'email' => $userEmail,
                'token' => $token,
                'created_at' => Time::now(),
            ];

            if ($email->send()) {
                $this->userToken->insert($user_token);

                return redirect()->back()->with('success', 'Email Berhasil dikirim');

            } else {
                return redirect()->back()->with('error', 'tidak dapat mengrim email');

            }

        } else {
            return redirect()->back()->with('error', 'email tidak terdaftar');
        }

    }

    public function resetPassword()
    {
        $email = $this->request->getGet('email');
        $user = $this->userModel->where('email', $email)->first();

        $token = $this->request->getGet('token');

        if ($user) {
            $userToken = $this->userToken->getBytoken($token);
            if ($userToken) {

                // dd($userToken);
                return view('/gakdipakai/resetPassword', [
                    'userToken' => $userToken,
                ]);
            } else {
                return redirect()->to(base_url('/login'))->with('error', 'Token Salah');
            }
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'email tidak terdaftar');

        }

    }

    public function gantiPassword()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $token = $this->request->getPost('token');

        // Cari pengguna berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            // Cari token berdasarkan token
            $userToken = $this->userToken->getByToken($token);

            if ($userToken) {
                // Hash password baru
                $userData = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];
                $this->userToken->delete($userToken['id']);

                $this->userModel->update($user['id'], $userData);

                // Redirect ke halaman login atau halaman lain yang sesuai
                return redirect()->to(base_url('/login'))->with('success', 'Password berhasil diperbarui Silahkan Login');
            } else {
                return redirect()->to(base_url('/login'))->with('error', 'Token Salah');
            }
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Email tidak terdaftar');
        }
    }

    public function ubahPassword()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('email', $email)->first();
        if ($user) {
            // Hash password baru
            $userData = [
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $this->userModel->update($user['id'], $userData);

            // Redirect ke halaman login atau halaman lain yang sesuai
            return redirect()->to(base_url('/login'))->with('success', 'Password berhasil diperbarui Silahkan Login');

        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Email tidak terdaftar');
        }
    }

}
