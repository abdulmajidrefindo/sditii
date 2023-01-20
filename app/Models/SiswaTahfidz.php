<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaTahfidz extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa_tahfidz";
    protected $fillable = ['id_siswa_tahfidz','id_siswa','id_tahfidz','nilai_angka'];
    public $timestamps = true;
}
