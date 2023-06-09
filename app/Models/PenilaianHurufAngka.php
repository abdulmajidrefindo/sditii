<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenilaianHurufAngka extends Model
{
    use HasFactory;
    protected $table = "penilaian_huruf_angkas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa_mapel()
    {
        return $this->hasMany(SiswaMapel::class);
    }
    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class);
    }
    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }
    public function siswa_hadist()
    {
        return $this->hasMany(SiswaHadist::class);
    }
}
