<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPdfToGenerate extends Migration
{
     public function up()
    {
        $this->forge->addColumn('generate', [
            'pdf' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('generate', 'pdf');
    }
}