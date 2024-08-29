<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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
        'user_id',
        'available',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class, 'garment_user')->withPivot(['status','reserved_at','description']);
    } 

}
