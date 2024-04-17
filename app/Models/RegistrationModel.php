<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
        $this->otps = $this->db->table('otps');
    }

    public function add_user($data)
    {
        return $this->users->insert($data);
    }

    public function add_otp($data)
    {
        return $this->otps->insert($data);
    }
}
