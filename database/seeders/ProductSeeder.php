<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Love Like Rain',
            'desc' => 'Love Like Rain by Charlotte Saughtry',
            'image' => 'https://creativeherald.com/wp-content/uploads/2012/06/Love-Like-Rain.jpg',
            'price' => 300,
            'category_id' => 1,
            'discount' => 5,
            'is_active' => 1,],

            ['name' => 'Ireland',
            'desc' => 'Ireland a Novel',
            'image' => 'https://reramble.files.wordpress.com/2013/02/redesign-loves-books_08.jpg',
            'price' => 250,
            'category_id' => 1,
            'discount' => 10,
            'is_active' => 1,]

        ]);
    }
}
