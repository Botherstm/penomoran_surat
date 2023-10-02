<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perihal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bidang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'subperihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255, 
                'null'=>true,
            ],
            'kode' => [
                'type' => 'INT',
                'constraint' => 11, 
            ],
            'name' => [
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
        $this->forge->createTable('perihal');
    }

    public function down()
    {
        $this->forge->dropTable('perihal');
    }
}