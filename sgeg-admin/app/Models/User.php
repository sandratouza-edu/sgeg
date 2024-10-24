<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'dni',
        'phone',
        'phone2',
        'degree_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $guard_name = 'web';


    public function pdi(): HasOne
    {
        return $this->hasOne(Pdi::class);
    }

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }
    
    /* User pdi is owner */
    public function garment(): HasMany
    {
        return $this->hasMany(Garment::class);
    }

    //Polimorfico con un solo valor
    public function attachment(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    
    }
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentsable');
    
    }

    
    public function seats():belongsToMany
    {
        return $this->belongsToMany(Seat::class, 'seat_user');
    } 

    /* User borrow some garments */
    public function garments():belongsToMany
    {
        return $this->belongsToMany(Garment::class, 'garment_user')->withPivot(['user_id','status','reserved_at','description']);
    } 
}
