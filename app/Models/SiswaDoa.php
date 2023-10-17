<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaDoa extends Model
{
    use HasFactory;
    protected $table = "siswa_doas";
    protected $fillable = ['id'];
    public $timestamps = true;

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
    public function doa_1()
    {
        return $this->belongsTo(Doa1::class);
    }
    public function doa_2()
    {
        return $this->belongsTo(Doa2::class);
    }
    public function doa_3()
    {
        return $this->belongsTo(Doa3::class);
    }
    public function doa_4()
    {
        return $this->belongsTo(Doa4::class);
    }
    public function doa_5()
    {
        return $this->belongsTo(Doa5::class);
    }
    public function doa_6()
    {
        return $this->belongsTo(Doa6::class);
    }
    public function doa_7()
    {
        return $this->belongsTo(Doa7::class);
    }
    public function doa_8()
    {
        return $this->belongsTo(Doa8::class);
    }
    public function doa_9()
    {
        return $this->belongsTo(Doa9::class);
    }
}
