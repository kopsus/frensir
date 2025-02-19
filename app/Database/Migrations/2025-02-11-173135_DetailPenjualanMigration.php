<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPenjualanMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DetailP_ID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Penjualan_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'Produk_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'Jumlah_Produk' => [
                'type'       => 'INT',
                'null'       => false,
            ],
        ]);
        $this->forge->addPrimaryKey('DetailP_ID');
        $this->forge->addForeignKey('Penjualan_id', 'sales', 'Penjualan_ID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Produk_id', 'products', 'Produk_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sales_details');
    }

    public function down()
    {
        $this->forge->dropTable('sales_details');
    }
}
