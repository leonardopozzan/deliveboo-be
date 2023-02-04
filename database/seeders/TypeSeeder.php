<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helpers;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('restaurants.types');
        foreach($types as $type){
            $new_type=new Type();
            $new_type->name = $type['type_name'];
            $new_type->slug=Helpers::generateSlug($new_type->name);
            $new_type->image = $type['type_imgPath'];
            $new_type->save();

        }
    }
}
