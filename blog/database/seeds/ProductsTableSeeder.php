<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Quần âu',
                'description' => 'Mô tả quần âu.',
                'price' => 2000000,
                'created_at' => date("Y-m-d H:i"),
                'updated_at' => date("Y-m-d H:i")
            ],
            [
                'name' => 'Quần kaki',
                'description' => 'Mô tả quần kaki.',
                'price' => 1000000,
                'created_at' => date("Y-m-d H:i"),
                'updated_at' => date("Y-m-d H:i")
            ],
            [
                'name' => 'Quần thô',
                'description' => 'Mô tả quần thô.',
                'price' => 1200000,
                'created_at' => date("Y-m-d H:i"),
                'updated_at' => date("Y-m-d H:i")
            ],
            [
                'name' => 'Quần jean',
                'description' => 'Mô tả jean.',
                'price' => 1400000,
                'created_at' => date("Y-m-d H:i"),
                'updated_at' => date("Y-m-d H:i")
            ],
            [
                'name' => 'Quần sooc',
                'description' => 'Mô tả quần sóc.',
                'price' => 50000,
                'created_at' => date("Y-m-d H:i"),
                'updated_at' => date("Y-m-d H:i")
            ]
        ]);
    }
}
