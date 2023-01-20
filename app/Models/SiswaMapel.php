<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaMapel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa_mapel";
    protected $fillable = ['id_siswa_mapel','id_siswa','id_tugas_mapel','nilai_angka'];
    public $timestamps = true;
}
