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
}
