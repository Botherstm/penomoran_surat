<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UrutanSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'instansi_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 225, 
            ],
            'urutan_surat' => [
                'type' => 'INT',
                'constraint' => 11, 
            ],
            'terlewat' => [
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
        $this->forge->createTable('urutan_surat');
    }

    public function down()
    {
        $this->forge->dropTable('urutan_surat');
    }
}