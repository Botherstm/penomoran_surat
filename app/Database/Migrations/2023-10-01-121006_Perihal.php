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
            'detail_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 225, 
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 225, 
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 225, 
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