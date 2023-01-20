<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaHadist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa_hadist";
    protected $fillable = ['id_siswa_hadist','id_siswa','id_hadist','nilai_angka'];
    public $timestamps = true;
}
