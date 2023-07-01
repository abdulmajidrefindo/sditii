<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doa4 extends Model
{
    use HasFactory;
    protected $table = "doas_4";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
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
