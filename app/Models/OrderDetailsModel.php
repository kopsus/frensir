<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailsModel extends Model
{
    protected $table            = 'detail_orders';
    protected $primaryKey       = 'DetailO_id';
    protected $allowedFields    = ['Order_id','Produk_id','Jumlah_Produk'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

}
