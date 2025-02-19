<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'User_id';
    protected $allowedFields    = ['Username','Email','Password', 'Role'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    public function getUserByEmail($username)
    {
        return $this->where('Username', $username)->first();
    }
}
