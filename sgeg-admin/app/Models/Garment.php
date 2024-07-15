<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
        'color',
        'with_cap',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(PDI::class);
    }

}
