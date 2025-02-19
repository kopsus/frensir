<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigrations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'User_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Username' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Role' => [
                'type'       => 'ENUM',
                'constraint' => ['Admin', 'Kasir'],
                'null'       => false,
            ],
        ]);
        $this->forge->addPrimaryKey('User_id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
