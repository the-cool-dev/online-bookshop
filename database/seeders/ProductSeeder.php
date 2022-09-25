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
            ['name' => 'The Power of your subconscious mind',
            'desc' => 'The Power of your subconscious mind by DR Joseph Murphy',
            'image' => 'https://kbimages1-a.akamaihd.net/cd8fb9ff-7ec7-46a2-b160-a15dc0826b40/1200/1200/False/the-power-of-your-subconscious-mind-11.jpg',
            'price' => 120,
            'category_id' => 1,
            'discount' => 5,
            'is_active' => 1,],

            ['name' => 'One night at the call center',
            'desc' => 'One night at the call center by Chetan Bhagat',
            'image' => 'https://m.media-amazon.com/images/I/61BK3EBvooL._AC_UL960_QL65_.jpg',
            'price' => 350,
            'category_id' => 1,
            'discount' => 10,
            'is_active' => 1,],

            ['name' => 'Murder on the orient express',
            'desc' => 'Murder on the orient express by Agatha Christie',
            'image' => 'https://i.pinimg.com/originals/98/c2/df/98c2dffae2f08699f2329b01ff15e497.jpg',
            'price' => 340,
            'category_id' => 1,
            'discount' => 10,
            'is_active' => 1,]

        ]);
    }
}
