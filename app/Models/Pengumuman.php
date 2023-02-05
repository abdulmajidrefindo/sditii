<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = "pengumumen";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
