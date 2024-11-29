<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm 5 bản ghi vào bảng products
        Product::create([
            'name' => 'Sản phẩm 1',
            'description' => 'Mô tả sản phẩm 1',
            'price' => 1000,
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Sản phẩm 2',
            'description' => 'Mô tả sản phẩm 2',
            'price' => 2000,
            'quantity' => 20,
        ]);

        Product::create([
            'name' => 'Sản phẩm 3',
            'description' => 'Mô tả sản phẩm 3',
            'price' => 3000,
            'quantity' => 15,
        ]);

        Product::create([
            'name' => 'Sản phẩm 4',
            'description' => 'Mô tả sản phẩm 4',
            'price' => 4000,
            'quantity' => 5,
        ]);

        Product::create([
            'name' => 'Sản phẩm 5',
            'description' => 'Mô tả sản phẩm 5',
            'price' => 5000,
            'quantity' => 8,
        ]);
    }
}
