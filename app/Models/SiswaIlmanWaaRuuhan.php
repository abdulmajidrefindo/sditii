<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaIlmanWaaRuuhan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa_ilman_waa_ruuhan";
    protected $fillable = ['id_siswa_iwr','id_siswa','id_iwr','nilai_angka'];
    public $timestamps = true;
}
