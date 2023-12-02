<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlmanWaaRuuhan extends Model
{
    use HasFactory;
    protected $table = "ilman_waa_ruuhans";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function siswa_iwr()
    {
        return $this->hasMany(SiswaIlmanWaaRuuhan::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function delete()
    {
        $this->siswa_iwr()->delete();
        return parent::delete();
    }
}
