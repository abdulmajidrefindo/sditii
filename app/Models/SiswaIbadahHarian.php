<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaIbadahHarian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa_ibadah_harian";
    protected $fillable = ['id_siswa_ih','id_siswa','id_ibadah_harian','nilai_angka'];
    public $timestamps = true;
}
