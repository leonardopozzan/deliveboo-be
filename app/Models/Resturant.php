<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resturant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
}
