<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifyModel extends Model
{

    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
        $this->otps = $this->db->table('otps');
    }

    public function get_user_by_id($id) {
        return $this->users->getWhere(['id' => session()->get('user_id')])->getRow();
    }

    public function get_otp_by_user_id($id) {
        $builder = $this->otps;
        $builder->where('user_id', $id);
        $builder->orderBy('id', 'DESC');
        return $builder->get()->getRow();
    }

    public function update_user($id)
    {
        $builder = $this->users;
        $builder->where('id', $id);
        return $builder->update(['status' => 1]);
    }
}
