<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'surname',
        'email',
        'dni'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    //Polimorfico con un solo valor
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    
    }
}
