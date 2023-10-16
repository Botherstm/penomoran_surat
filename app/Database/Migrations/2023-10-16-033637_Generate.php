<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Generate extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                // 'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'instansi_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bidang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'urutan_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('generate');
    }

    public function down()
    {
        //
    }
}