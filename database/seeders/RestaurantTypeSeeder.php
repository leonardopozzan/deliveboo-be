<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants.restaurants');
        foreach($restaurants as $restaurant) {
            foreach ($restaurant['type_id'] as $type)
                DB::table('restaurant_type')->insert([
                    'restaurant_id' => Restaurant::where('name', $restaurant['name'])->first()->id,
                    'type_id' => $type,
                ]);
        }
    }
}
