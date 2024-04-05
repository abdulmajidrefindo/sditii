<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, SoftDeletes;
    protected $table = "user";
    protected $guarded = ['id'];
    // protected $fillable = ['name','user_name','email','email_verified_at','remember_token','createdAt','updatedAt','deleted_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $timestamps = true;

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
    public static function boot() {
        parent::boot();
        static::deleting(function($user)
        {
             $user->role()->detach();
             $user->guru()->delete();
             $user->pengumuman()->delete();
        });
    }
}
