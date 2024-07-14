<?php

namespace App\Models;

use App\Casts\Encrypt;
use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manager_id',
        'username',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'photo_profile',
        'user_type',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => Encrypt::class,
    ];

    protected $appends = ['full_name'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function inferiors()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function getAllInferiors()
    {
        return $this->inferiors()->with('getAllInferiors');
    }

    public function DailyLogs()
    {
        return $this->hasMany(DailyLog::class, 'user_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
