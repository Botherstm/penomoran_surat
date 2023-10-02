<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subperihal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'urutan_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255, 
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
        $this->forge->createTable('subperihal');
    }

    public function down()
    {
        $this->forge->dropTable('subperihal');
    }
}