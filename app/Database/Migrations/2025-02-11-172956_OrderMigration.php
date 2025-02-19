<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Order_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Order_Code' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Order_Date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'Status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'success', 'rejected'],
                'null'       => false,
            ],
        ]);
        $this->forge->addPrimaryKey('Order_id');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
