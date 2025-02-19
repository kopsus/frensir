<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categoryModel = new CategoryModel();
        $data = [
            [
                'Category_name' => 'Food',
            ],
            [
                'Category_name' => 'Drink',
            ],
            [
                'Category_name' => 'Side Dish',
            ]
        ];
        $categoryModel->insertBatch($data);
    }
}
