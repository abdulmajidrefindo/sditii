<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "kelas";
    protected $fillable = ['id_kelas','nama_kelas','id_siswa','id_guru'];
    public $timestamps = true;
}
