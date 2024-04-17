<?php

namespace App\Controllers;

class WhatsappController extends BaseController
{
    public function index(): string
    {
        $data = [
          'title' => 'Whatsapp',
        ];
        return view('WhatsappView', $data);
    }

    public function qr()
    {
        $wa = new \App\Libraries\Whatsapp();
        $data = $wa->get_qr();
        if (is_null($data) || empty($data)) {
            $data = [
                'error' => true,
                'message' => 'Server not running',
            ];
        } else {
            $data = $data;
        }

        return $this->response->setJSON($data);
    }
}
