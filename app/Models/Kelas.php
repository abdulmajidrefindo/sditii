<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function rapor_siswa()
    {
        return $this->belongsTo(RaporSiswa::class);
    }
    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class);
    // }
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
