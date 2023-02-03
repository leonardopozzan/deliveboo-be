<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Addition extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class);
    }
}
