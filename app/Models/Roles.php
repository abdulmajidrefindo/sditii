<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'id', 'user_id')->withTimestamps();
    }
}
