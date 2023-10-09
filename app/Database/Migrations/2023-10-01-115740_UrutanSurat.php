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
            'perihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'=>true, 
            ],
            'subperihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255, 
                'null'=>true,
            ],
            'nomor' => [
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