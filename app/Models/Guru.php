<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory;
    protected $table = "gurus";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ibadah_harian()
    {
        return $this->hasMany(IbadahHarian::class);
    }
    public function ilman_waa_ruuhan()
    {
        return $this->hasMany(IlmanWaaRuuhan::class);
    }
    public function bidang_studi()
    {
        return $this->hasMany(BidangStudi::class);
    }
    public function tahfidz_1()
    {
        return $this->hasMany(Tahfidz1::class);
    }
    
    public function doa_1()
    {
        return $this->hasMany(Doa1::class);
    }
    
    public function hadist_1()
    {
        return $this->hasMany(Hadist1::class);
    }
    
    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }

    public function sub_kelas()
    {
        return $this->hasMany(SubKelas::class)->with('kelas');
    }

    //delete all child on delete
    
}
