<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helpers;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes=config('dataseeder.dishes');
        foreach($dishes as $dish){
            foreach($dish['restaurant_id'] as $restaurant){
                $new_dish = new Dish();
                $new_dish->name=$dish['name'];
                $new_dish->slug=Dish::getSlug($new_dish->name , $restaurant);
                
                $new_dish->price=$dish['price'];
                $new_dish->visible = 1;
                $new_dish->ingredients=$dish['ingredients'];
                $new_dish->image = $dish['image'];
                $new_dish->restaurant_id = $restaurant;
                $new_dish->category_id = $dish['category_id'];
                $new_dish->save();
                
                
            }
        }

    }
}
