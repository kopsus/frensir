<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Produk_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'Category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Nama_Produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Gambar_Produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Rasa' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Harga' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'Star' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'Deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Waktu' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'Stok' => [
                'type'       => 'INT',
                'null'       => false,
            ],
        ]);
        $this->forge->addPrimaryKey('Produk_id');
        $this->forge->addForeignKey('Category_id', 'categories', 'Category_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
