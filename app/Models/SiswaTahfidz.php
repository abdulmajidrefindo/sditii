<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaTahfidz extends Model
{
    use HasFactory;    
    protected $table = "siswa_tahfidzs";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tahfidz()
    {
        return $this->belongsTo(Tahfidz::class);
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
    public function tahfidz_2()
    {
        return $this->belongsTo(Tahfidz2::class);
    }
    public function tahfidz_3()
    {
        return $this->belongsTo(Tahfidz3::class);
    }
    public function tahfidz_4()
    {
        return $this->belongsTo(Tahfidz4::class);
    }
    public function tahfidz_5()
    {
        return $this->belongsTo(Tahfidz5::class);
    }
    public function tahfidz_6()
    {
        return $this->belongsTo(Tahfidz6::class);
    }
    public function tahfidz_7()
    {
        return $this->belongsTo(Tahfidz7::class);
    }
    public function tahfidz_8()
    {
        return $this->belongsTo(Tahfidz8::class);
    }
    public function tahfidz_9()
    {
        return $this->belongsTo(Tahfidz9::class);
    }
    public function tahfidz_10()
    {
        return $this->belongsTo(Tahfidz10::class);
    }
    public function tahfidz_11()
    {
        return $this->belongsTo(Tahfidz11::class);
    }
    public function tahfidz_12()
    {
        return $this->belongsTo(Tahfidz12::class);
    }
    public function tahfidz_13()
    {
        return $this->belongsTo(Tahfidz13::class);
    }
    public function tahfidz_14()
    {
        return $this->belongsTo(Tahfidz14::class);
    }
    public function tahfidz_15()
    {
        return $this->belongsTo(Tahfidz15::class);
    }
}
