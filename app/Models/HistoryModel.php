<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table      = 'history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Order_Code', 'Order_Date'];
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
}
