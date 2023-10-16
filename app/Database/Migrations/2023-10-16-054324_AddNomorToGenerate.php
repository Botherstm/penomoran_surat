<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNomorToGenerate extends Migration
{
    public function up()
    {
    $this->forge->addColumn('generate', [
            'nomor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('generate', 'nomor');
    }
}