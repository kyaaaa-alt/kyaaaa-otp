<?php

namespace App\Controllers;

class WhatsappController extends BaseController
{
    public function index(): string
    {
        return view('WhatsappView');
    }
}
