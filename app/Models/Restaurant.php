<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // public function orders()
    // {
    //     $dishes = $this->dishes;
    //     $orders = [];
    //     foreach ($dishes as $dish) {
    //         $all_orders = $dish->orders;
    //         foreach ($all_orders as $order) {
    //             if( ! in_array($order, $orders) ){
    //                 array_push($orders, $order);
    //             }
    //         }
    //     }
    //     return $orders;
    // }
}
