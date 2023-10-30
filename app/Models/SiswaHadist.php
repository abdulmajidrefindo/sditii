<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaHadist extends Model
{
    use HasFactory;
    protected $table = "siswa_hadists";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'siswa_id',
        'hadist_1_id',
        'profil_sekolah_id',
        'periode_id',
        'rapor_siswa_id',
        'penilaian_huruf_angka_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function hadist_1()
    {
        return $this->belongsTo(Hadist1::class);
    }
    public function profil_sekolah()
    {
        return $this->belongsTo(ProfilSekolah::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
    public function rapor_siswa()
    {
        return $this->belongsTo(RaporSiswa::class);
    }
    public function penilaian_huruf_angka()
    {
        return $this->belongsTo(PenilaianHurufAngka::class);
    }
    
}
