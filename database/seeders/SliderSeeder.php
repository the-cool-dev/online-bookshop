<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sliders')->insert([
            [
            'image' => 'https://www.dailysignal.com/wp-content/uploads/MerriamWebster.jpg',
            'is_active' => 1,
            ],

            [
                'image' => 'https://www.ninjadesignstudio.com/wp-content/uploads/2021/09/Untitled-design-1.jpg',
                'is_active' => 1,
            ],

        ]);
    }
}
