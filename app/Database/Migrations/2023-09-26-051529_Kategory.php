<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                // 'auto_increment' => true,
            ],
            'dinas_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255, 
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nomor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'urutan_surat' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}