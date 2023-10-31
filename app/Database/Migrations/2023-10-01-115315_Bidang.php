<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bidang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                // 'auto_increment' => true,
            ],
            'instansi_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255, 
            ],
             'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('bidang');
    }

    public function down()
    {
        $this->forge->dropTable('bidang');
    }
}