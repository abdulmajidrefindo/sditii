<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenilaianHurufAngka extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "penilaian_huruf_angka";
    protected $fillable = ['nilai_angka','nilai_huruf','keterangan_angka'];
    public $timestamps = true;
}
