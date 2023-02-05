<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaIlmanWaaRuuhan extends Model
{
    use HasFactory;
    protected $table = "siswa_ilman_waa_ruuhans";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function ilman_waa_ruuhan()
    {
        return $this->belongsTo(IlmanWaaRuuhan::class);
    }
    public function penilaian_deskripsi()
    {
        return $this->belongsTo(PenilaianDeskripsi::class);
    }
}
