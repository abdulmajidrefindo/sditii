<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = "mapels";
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'nama_mapel',
        'guru_id',
        'kelas_id',
        'periode_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function siswa_bidang_studi()
    {
        return $this->hasMany(SiswaBidangStudi::class);
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
        $this->siswa_bidang_studi()->delete();
        return parent::delete();
    }
}
