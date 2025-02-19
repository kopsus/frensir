<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailOrderMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DetailO_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Order_id' => [
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
        $this->forge->addPrimaryKey('DetailO_id');
        $this->forge->addForeignKey('Order_id', 'orders', 'Order_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Produk_id', 'products', 'Produk_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_orders');
    }

    public function down()
    {
        $this->forge->dropTable('detail_orders');
    }
}
