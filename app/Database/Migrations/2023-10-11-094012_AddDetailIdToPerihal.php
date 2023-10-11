<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailIdToPerihal extends Migration
{
    public function up()
    {
         $this->forge->addColumn('perihal', [
        'detail_id' => [
            'type' => 'varchar',
            'constraint' => 255,
            'null' => true, // Sesuaikan dengan kebutuhan Anda
        ],
    ]);
    }

    public function down()
    {
        $this->forge->dropColumn('perihal', 'detail_id');
    }
}