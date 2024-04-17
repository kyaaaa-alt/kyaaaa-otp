<?php

namespace App\Controllers;
use App\Models\VerifyModel;

class VerifyController extends BaseController
{
    public function __construct()
    {
        $this->VerifyModel = new VerifyModel();
    }

    public function index(): string
    {
        return view('VerificationView');
    }

    public function verify()
    {
        $otp = $this->request->getPost('otp');
        $get_otp = $this->VerifyModel->get_otp_by_user_id(session()->get('user_id'));
        $expire = $get_otp->expire;
        if ($otp == $get_otp->otp && $expire > time()) {
            $update_status_user = $this->VerifyModel->update_user(session()->get('user_id'));
            if ($update_status_user) {
                $this->response->setStatusCode(200, 'OK');
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'User berhasil terverifikasi',
                ]);
            }
        } else {
            $this->response->setStatusCode(200, 'OK');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'OTP yang anda masukkan salah/kadaluarsa',
            ]);
        }
    }
}
