<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesDetailsModel extends Model
{
    protected $table            = 'sales_details';
    protected $primaryKey       = 'DetailP_ID';
    protected $allowedFields    = ['Jumlah_Produk', 'Penjualan_id', 'Produk_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
}
