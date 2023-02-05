<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IbadahHarian extends Model
{
    use HasFactory;
    protected $table = "ibadah_harians";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function siswa_ibadah_harian()
    {
        return $this->hasMany(SiswaIbadahHarian::class);
    }
    public function guru()
    {
            return $this->belongsTo(Guru::class);
    }
}
