<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa";
    protected $fillable = ['id_siswa','nisn','nama_siswa','orangtuawali_siswa','id_kelas'];
    public $timestamps = true;
}
