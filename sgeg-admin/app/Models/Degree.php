<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $fillable = [
        'name' ,
        'color',
        'description',
        'active'
    ];
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}