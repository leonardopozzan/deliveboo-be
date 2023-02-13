<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //odrer che noi usiamo per vedere come funziona e altro 
        //ordini creati con faker.
        for ($i = 0; $i < 30; $i++) {
            $order = new Order;
            $order->code = $faker->regexify('[A-Z]{6}[0-9]{6}');
            $order->name = $faker->name();
            $order->address = $faker->address();
            $order->phone_number = '3334658728';
            $order->email = $faker->email();
            $order->date = $faker->dateTimeThisYear();
            $order->total_price = $faker->randomFloat(2, 1, 100);
            $order->payment_status = $faker->boolean();
            //dd($order);
            $order->save();
        }
    }
}