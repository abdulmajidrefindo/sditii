<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TugasMapel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "tugas_mapel";
    protected $fillable = ['id_tugas_mapel','id_mapel','nama_tugas'];
    public $timestamps = true;
}
