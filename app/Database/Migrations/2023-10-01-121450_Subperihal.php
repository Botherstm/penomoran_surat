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
            'perihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 225, 
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
        $this->forge->createTable('sub_perihal');
    }

    public function down()
    {
        $this->forge->dropTable('sub_perihal');
    }
}