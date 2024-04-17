<?php

namespace App\Controllers;

class OTPController extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
