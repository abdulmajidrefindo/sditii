<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penilaian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "penilaian";
    protected $fillable = ['nilai_angka','nilai_huruf','nilai_deskripsi','keterangan_deskripsi'];
    public $timestamps = true;
}
