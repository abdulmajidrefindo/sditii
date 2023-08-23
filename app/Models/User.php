<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model 
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "user";
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsToMany(Roles::class, 'user_roles', 'id', 'role_id')->withTimestamps();
    }
    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }
}
