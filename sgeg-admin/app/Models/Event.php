<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function degree(): HasMany
    {
        return $this->hasMany(Degree::class);
    }
}
