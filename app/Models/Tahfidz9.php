<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahfidz9 extends Model
{
    use HasFactory;
    protected $table = "tahfidzs_9";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class);
    }
    public function penilaian_huruf_angka()
    {
        return $this->belongsTo(PenilaianHurufAngka::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
