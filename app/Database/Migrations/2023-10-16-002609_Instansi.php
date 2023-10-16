<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Instansi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                // 'auto_increment' => true,
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
        $this->forge->createTable('instansi');
    }

    public function down()
    {
         $this->forge->dropTable('instansi');
    }
}