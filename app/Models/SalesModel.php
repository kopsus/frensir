<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'Penjualan_ID';
    protected $allowedFields    = ['Order_id', 'Tanggal_Penjualan', 'Total_Harga'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
}