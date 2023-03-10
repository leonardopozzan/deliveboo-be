<?php

namespace Database\Seeders;

use App\Models\Addition;
use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdditionDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = Dish::where('category_id' , 7)->get();
        $additions = Addition::all();
        $countAdditions = $additions->count();
        foreach ($dishes as $dish){
            for($i = 1; $i <= $countAdditions; $i++){
                DB::table('addition_dish')->insert([
                    'addition_id' => $i,
                    'dish_id' => $dish->id,
                ]);
            }
        }
    }
}
