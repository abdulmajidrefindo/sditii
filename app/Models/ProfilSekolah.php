<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilSekolah extends Model
{
    use HasFactory;
    protected $table = "profil_sekolahs";
    protected $guarded = ['id'];
    public $timestamps = true;
}
