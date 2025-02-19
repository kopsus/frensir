<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenjualanMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Penjualan_ID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Tanggal_Penjualan' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'Total_Harga' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'Order_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);
        $this->forge->addPrimaryKey('Penjualan_ID');
        $this->forge->addForeignKey('Order_id', 'orders', 'Order_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
