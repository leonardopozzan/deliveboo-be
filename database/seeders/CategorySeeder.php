<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('dataseeder.categories');
        foreach($categories as $category){
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Helpers::generateSlug($new_category->name);
            $new_category->save();


        }
    }
}
