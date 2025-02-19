<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'Category_id';
    protected $allowedFields = ['Category_name'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
}
