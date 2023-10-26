<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaTahfidz extends Model
{
    use HasFactory;    
    protected $table = "siswa_tahfidzs";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'siswa_id',
        'tahfidz_1_id',
        'profil_sekolah_id',
        'periode_id',
        'rapor_siswa_id',
        'penilaian_huruf_angka_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function penilaian_huruf_angka()
    {
        return $this->belongsTo(PenilaianHurufAngka::class);
    }
    public function rapor_siswa()
    {
        return $this->belongsTo(RaporSiswa::class);
    }
    public function profil_sekolah()
    {
        return $this->belongsTo(ProfilSekolah::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
    public function tahfidz_1()
    {
        return $this->belongsTo(Tahfidz1::class);
    }
}
