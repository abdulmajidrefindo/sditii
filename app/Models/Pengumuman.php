<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "pengumuman";
    protected $fillable = ['judul','isi','created_at','updated_at'];
    public $timestamps = true;
}
