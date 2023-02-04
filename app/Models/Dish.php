<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Restaurant;
use Illuminate\Support\Str;


class Dish extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
    public static function getSlug($name, $id_restaurant)
    {
        $restaurant = Restaurant::where('id',$id_restaurant)->first();

        $restaurant_name = $restaurant->name;

        $name_concateneted = $restaurant_name . '-' . $name;

        $slug = Str::slug($name_concateneted);

        return $slug;

    }
}
