<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOtpsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint'     => 11,
            ],
            'otp' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'expire' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('otps');
    }

    public function down()
    {
        $this->forge->dropTable('otps');
    }
}
