<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;


class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $orders = Order::take(10)->get();
        $dishes = Dish::where('restaurant_id',1)->get();
        foreach($orders as $order) {
            foreach ($dishes as $dish) {
                DB::table('dish_order')->insert([
                    'dish_id' => $dish->id,
                    'order_id' => $order->id,
                    'quantity' => $faker->randomDigit(),
                    'current_price' => $dish->price,
                ]);
            }
        }
        $orders = Order::skip(10)->take(10)->get();
        $dishes = Dish::where('restaurant_id',2)->get();
        foreach($orders as $order) {
            foreach ($dishes as $dish) {
                DB::table('dish_order')->insert([
                    'dish_id' => $dish->id,
                    'order_id' => $order->id,
                    'quantity' => $faker->randomDigit(),
                    'current_price' => $dish->price,
                ]);
            }
        }
        $orders = Order::skip(20)->take(10)->get();
        $dishes = Dish::where('restaurant_id',3)->get();
        foreach ($orders as $order) {
            foreach ($dishes as $dish) {
                DB::table('dish_order')->insert([
                    'dish_id' => $dish->id,
                    'order_id' => $order->id,
                    'quantity' => $faker->randomDigit(),
                    'current_price' => $dish->price,
                ]);
            }
        }
    }
}
