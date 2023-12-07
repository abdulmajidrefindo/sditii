<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RaporSiswa extends Model
{
    use HasFactory;
    protected $table = "rapor_siswas";
    protected $guarded = ['id'];
    //fillable
    protected $fillable = ['tempat','tanggal'];
    public $timestamps = true;

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
    public function siswa_iwr()
    {
        return $this->hasMany(SiswaIlmanWaaRuuhan::class);
    }
    public function siswa_ih()
    {
        return $this->hasMany(SiswaIbadahHarian::class);
    }
    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }
    public function siswa_hadist()
    {
        return $this->hasMany(SiswaHadist::class);
    }
    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class);
    }
    public function siswa_mapel()
    {
        return $this->hasMany(SiswaMapel::class);
    }
    public function siswa_bidang_studi()
    {
        return $this->hasMany(SiswaBidangStudi::class);
    }
}
