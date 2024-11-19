<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Seat extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public $timestamps = false;
    
    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class, 'seat_user');
    } 

    public function room():BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
