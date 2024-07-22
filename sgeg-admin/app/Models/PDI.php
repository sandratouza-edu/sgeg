<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class PDI extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guarded = [];

    public function garment(): HasMany
    {
        return $this->hasMany(Garment::class);
    }
    

}