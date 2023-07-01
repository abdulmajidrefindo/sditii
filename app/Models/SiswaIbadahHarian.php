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
    public function ibadah_harian_1()
    {
        return $this->belongsTo(IbadahHarian1::class);
    }
    public function ibadah_harian_2()
    {
        return $this->belongsTo(IbadahHarian2::class);
    }
    public function ibadah_harian_3()
    {
        return $this->belongsTo(IbadahHarian3::class);
    }
    public function ibadah_harian_4()
    {
        return $this->belongsTo(IbadahHarian4::class);
    }
    public function ibadah_harian_5()
    {
        return $this->belongsTo(IbadahHarian5::class);
    }
    public function ibadah_harian_6()
    {
        return $this->belongsTo(IbadahHarian6::class);
    }
    public function ibadah_harian_7()
    {
        return $this->belongsTo(IbadahHarian7::class);
    }
    public function ibadah_harian_8()
    {
        return $this->belongsTo(IbadahHarian8::class);
    }
    public function ibadah_harian_9()
    {
        return $this->belongsTo(IbadahHarian9::class);
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
