<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaBidangStudi extends Model
{
    use HasFactory;
    protected $table = "siswa_bidang_studis";
    protected $fillable = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
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
    public function nilai_uh_1()
    {
        return $this->belongsTo(NilaiUh1::class);
    }
    public function nilai_uh_2()
    {
        return $this->belongsTo(NilaiUh2::class);
    }
    public function nilai_uh_3()
    {
        return $this->belongsTo(NilaiUh3::class);
    }
    public function nilai_uh_4()
    {
        return $this->belongsTo(NilaiUh4::class);
    }
    public function nilai_tugas_1()
    {
        return $this->belongsTo(NilaiTugas1::class);
    }
    public function nilai_tugas_2()
    {
        return $this->belongsTo(NilaiTugas2::class);
    }
    public function nilai_uts()
    {
        return $this->belongsTo(NilaiUts::class);
    }
    public function nilai_pas()
    {
        return $this->belongsTo(NilaiPas::class);
    }
}
