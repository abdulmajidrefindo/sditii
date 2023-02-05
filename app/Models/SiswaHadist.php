<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaHadist extends Model
{
    use HasFactory;
    protected $table = "siswa_hadists";
    protected $fillable = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function hadist()
    {
        return $this->belongsTo(Hadist::class);
    }
    public function penilaian_deskripsi()
    {
        return $this->belongsTo(PenilaianDeskripsi::class);
    }
}
