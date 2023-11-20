<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasswordDefault extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password_default' => [
                'type' => 'TEXT',
          
            ],
             'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('password_default');
    }

    public function down()
    {
        $this->forge->dropTable('password_default');
    }
}