<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlmanWaaRuuhan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "ilman_waa_ruuhan";
    protected $fillable = ['id_iwr','pencapaian','jilid','halaman','id_guru'];
    public $timestamps = true;
}
