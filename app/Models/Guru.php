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
}
