<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helpers;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants.restaurants');

        foreach ($restaurants as $key => $restaurant) {

            $new_restaurant = new Restaurant();
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->slug = Helpers::generateSlug($new_restaurant->name);
            $new_restaurant->email = $restaurant['email'];
            $new_restaurant->image = $restaurant['image'];
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->p_iva = $restaurant['partita_iva'];
            $new_restaurant->website = $restaurant['website'];
            $new_restaurant->opening_hours = $restaurant['opening_hours'];
            $new_restaurant->closing_hours = $restaurant['closing_hours'];
            $new_restaurant->phone_number = $restaurant['phone_number'];
            $new_restaurant->user_id = $key + 1;
            $new_restaurant->save();
        }
    }
}
