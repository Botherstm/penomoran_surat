<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GenerateNomorSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'instansi_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bidang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kategori_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'perihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'sub_perihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'detail_sub_perihal_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'urutan_surat-id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('generate_nomor-surat');
    }

    public function down()
    {
        $this->forge->dropTable('generate_nomor-surat');
    }
}