<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaDoa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "siswa";
    protected $fillable = ['id_siswa_doa','id_siswa','id_doa','nilai_angka'];
    public $timestamps = true;
}
