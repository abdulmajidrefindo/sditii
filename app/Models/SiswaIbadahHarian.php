<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaIbadahHarian extends Model
{
    use HasFactory;
    protected $table = "siswa_ibadah_harians";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function ibadah_harian()
    {
        return $this->belongsTo(IbadahHarian::class);
    }
    public function penilaian_deskripsi()
    {
        return $this->belongsTo(PenilaianDeskripsi::class);
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
}
