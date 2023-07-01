<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaHadist extends Model
{
    use HasFactory;
    protected $table = "siswa_hadists";
    protected $fillable = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function hadist()
    {
        return $this->belongsTo(Hadist::class);
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
    public function hadist_1()
    {
        return $this->belongsTo(Hadist1::class);
    }
    public function hadist_2()
    {
        return $this->belongsTo(Hadist2::class);
    }
    public function hadist_3()
    {
        return $this->belongsTo(Hadist3::class);
    }
    public function hadist_4()
    {
        return $this->belongsTo(Hadist4::class);
    }
    public function hadist_5()
    {
        return $this->belongsTo(Hadist5::class);
    }
    public function hadist_6()
    {
        return $this->belongsTo(Hadist6::class);
    }
    public function hadist_7()
    {
        return $this->belongsTo(Hadist7::class);
    }
    public function hadist_8()
    {
        return $this->belongsTo(Hadist8::class);
    }
    public function hadist_9()
    {
        return $this->belongsTo(Hadist9::class);
    }
}
