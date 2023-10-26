<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaIbadahHarian extends Model
{
    use HasFactory;
    protected $table = "siswa_ibadah_harians";
    public $timestamps = true;

    protected $fillable = [
        'id',
        'siswa_id',
        'ibadah_harian_1_id',
        'profil_sekolah_id',
        'periode_id',
        'rapor_siswa_id',
        'penilaian_deskripsi_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function ibadah_harian_1()
    {
        return $this->belongsTo(IbadahHarian1::class);
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

    public function penilaian_deskripsi()
    {
        return $this->belongsTo(PenilaianDeskripsi::class, 'penilaian_deskripsi_id', 'id');
    }
    
    
}
