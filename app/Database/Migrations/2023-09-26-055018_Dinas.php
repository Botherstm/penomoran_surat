<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dinas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                // 'auto_increment' => true,
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
        $this->forge->createTable('dinas');
    }

    public function down()
    {
        $this->forge->dropTable('dinas');
    }
}