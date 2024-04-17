<?php

namespace App\Controllers;

use App\Models\RegistrationModel;

class RegistrationController extends BaseController
{
    public function __construct()
    {
        $this->RegistrationModel = new RegistrationModel();
    }

    public function index(): string
    {
        $data = [
          'title' => 'Register'
        ];
        return view('RegistrationView', $data);
    }

    public function submit()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $whatsapp = $this->request->getPost('whatsapp');
        $password = $this->request->getPost('password');

        $data = [
            'name' => $name,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'status' => 0
        ];

        $insert = $this->RegistrationModel->add_user($data);
        if ($insert) {
            $user_id = db_connect()->insertID();
            $now = time();
            $expire = $now + (30 * 60); // batas otp 30 menit
            $otp = rand(100000, 999999);
            $data_otp = [
                'user_id' => $user_id,
                'otp' => $otp,
                'expire' => $expire
            ];
            $insert_otp = $this->RegistrationModel->add_otp($data_otp);
            if ($insert_otp) {
                session()->set([
                    'logged_in' => true,
                    'user_id' => $user_id
                ]);
                $wa = new \App\Libraries\Whatsapp();
                $wa_status = $wa->get_qr();
                $msg = "Kode OTP anda adalah: {$otp}";
                if (!is_null($wa_status) || !empty($wa_status)) {
                    $get_wa_status = $wa_status->message;
                    if ($get_wa_status == 'connected')  {
                        $retry = 0;
                        $max_retries = 3;
                        do {
                            $send_otp = $wa->send_message($whatsapp, $msg);
                            $retry++;
                            if ($send_otp->error && $retry < $max_retries) {
                                sleep(3);
                            }
                        } while ($send_otp->error && $retry < $max_retries);
                    }
                }
                $this->response->setStatusCode(200, 'OK');
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'OTP telah dikirim ke whatsapp anda!'
                ]);
            }
        } else {
            $this->response->setStatusCode(400, 'Bad Request');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Registrasi Gagal'
            ]);
        }
    }
}
