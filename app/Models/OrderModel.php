<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'Order_id';
    protected $allowedFields    = ['Order_Code','Order_Date','Status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

}
