<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PDI extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Garment(): BelongsTo
    {
        return $this->belongsTo(Garment::class);
    }
}