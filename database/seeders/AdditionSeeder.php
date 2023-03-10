<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Addition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $additions = config('additions');
        foreach($additions as $addition){
            $new_addition = new Addition();
            $new_addition->name = $addition['name'];
            $new_addition->slug = Helpers::generateSlug($new_addition->name);
            $new_addition->price = $addition['price'];
            $new_addition->save();
        }
    }
}
