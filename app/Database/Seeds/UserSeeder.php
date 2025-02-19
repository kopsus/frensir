<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $data = [
            [
                'Username' => 'admin',
                'Email'    => 'admin@example.com',
                'Password' => password_hash('admin', PASSWORD_DEFAULT), // Hashed password
                'Role'     => 'Admin'
            ],
            [
                'Username' => 'kasir',
                'Email'    => 'kasir@example.com',
                'Password' => password_hash('kasir', PASSWORD_DEFAULT), // Hashed password
                'Role'     => 'Kasir'
            ]
        ];
        $userModel->insertBatch($data);
    }
}
