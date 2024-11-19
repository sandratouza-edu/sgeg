<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\Seat;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'structure',
        'description'
    ];

    protected function structure(): Attribute {
        return Attribute::make(
            get: fn ($value) => json_decode($value, associative: true),
            set: fn ($value) => $value,
        );
        
    }
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
