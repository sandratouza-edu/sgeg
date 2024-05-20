<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name' ,
        'height' ,
        'width' ,
        'waist' ,
        'size_cap',
        'color'  ,
        'with_cap' ,
    ];
}
