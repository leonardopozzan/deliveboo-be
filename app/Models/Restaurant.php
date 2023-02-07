<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
class Restaurant extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function types(): BelongsToMany
   {
       return $this->belongsToMany(Type::class);
   }
   public function dishes(): HasMany
   {
       return $this->hasMany(Dish::class);
   }

   public static function getRestaurantId($user_id){
    $restaurant = Restaurant::where('user_id', $user_id)->first();
    $restaurant_id = $restaurant->id;
    return $restaurant_id;
   }

}
