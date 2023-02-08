<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function siswa_ibadah_harian()
    {
        return $this->hasMany(SiswaIbadahHarian::class);
    }
    public function ibadah_harian()
    {
        return $this->hasMany(IbadahHarian::class);
    }
    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class);
    }
    public function tahfidz()
    {
        return $this->hasMany(Tahfidz::class);
    }
    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }
    public function doa()
    {
        return $this->hasMany(Doa::class);
    }
    public function siswa_iwr()
    {
        return $this->hasMany(SiswaIlmanWaaRuuhan::class);
    }
    public function ilman_waa_ruuhan()
    {
        return $this->hasMany(IlmanWaaRuuhan::class);
    }
    public function siswa_mapel()
    {
        return $this->hasMany(SiswaMapel::class);
    }
    public function rapor_siswa()
    {
        return $this->hasMany(RaporSiswa::class);
    }
}
