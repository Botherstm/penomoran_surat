<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LupaPasswordController extends BaseController
{
    public function index()
    {
        //
    }
    public function sendEmail()
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

        // dd($config);
        // Load library email
        $email = \Config\Services::email();
        $email->initialize($config);

        // Set email subject, sender, and recipient
        $email->setNewLine("\r\n");
        $email->setFrom('e.nomor252@gmail.com', 'E-Nomor Buleleng');
        $email->setTo('yonimheswara@gmail.com');

        // Set email subject
        $email->setSubject('Reset password');

        // Set email message
        $email->setMessage('Email content goes here');

        // Send the email
        if ($email->send()) {
            echo 'Email telah berhasil dikirim';
        } else {
            echo 'Email gagal dikirim. Pesan kesalahan: ' . $email->printDebugger();
            die;
        }
    }

}
