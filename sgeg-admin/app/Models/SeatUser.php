<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SeatUser extends Model
{
    use HasFactory;

    protected $table = 'seat_user';

    public $timestamps = false;
    protected $guarded = [];
    
}
