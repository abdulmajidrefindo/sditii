<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaTahfidz extends Model
{
    use HasFactory;    
    protected $table = "siswa_tahfidzs";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tahfidz()
    {
        return $this->belongsTo(Tahfidz::class);
    }
    public function penilaian_deskripsi()
    {
        return $this->belongsTo(PenilaianDeskripsi::class);
    }
}
