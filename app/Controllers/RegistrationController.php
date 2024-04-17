<?php

namespace App\Controllers;

class RegistrationController extends BaseController
{
    public function index(): string
    {
        $data = [
          'title' => 'Register'
        ];
        return view('RegistrationView', $data);
    }

    public function submit()
    {

    }
}
