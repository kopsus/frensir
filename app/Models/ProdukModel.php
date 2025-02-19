<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'Produk_id';
    protected $allowedFields    = ['Category_id','Nama_Produk','Gambar_Produk','Rasa','Harga','Star','Deskripsi','Waktu','Stok'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    public function getProductsWithCategory()
    {
        return $this->select('products.*, categories.Nama_Kategori')
                    ->join('categories', 'categories.Category_id = products.Category_id')
                    ->findAll();
    }
}
