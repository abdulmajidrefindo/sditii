<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUh2 extends Model
{
    use HasFactory;
    protected $table = "nilai_uhs_2";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa_bidang_studi()
    {
        return $this->hasMany(SiswaBidangStudi::class);
    }
    public function penilaian_huruf_angka()
    {
        return $this->belongsTo(PenilaianHurufAngka::class);
    }
}
