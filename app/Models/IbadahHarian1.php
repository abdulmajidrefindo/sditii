<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IbadahHarian1 extends Model
{
    use HasFactory;
    protected $table = "ibadah_harians_1";
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'nama_kriteria',
        'guru_id',
        'kelas_id',
        'periode_id',
    ];

    public function siswa_ibadah_harian()
    {
        return $this->hasMany(SiswaIbadahHarian::class, 'ibadah_harian_1_id', 'id');
    }
    // public function penilaian_deskripsi()
    // {
    //     return $this->belongsTo(PenilaianDeskripsi::class);
    // }
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
        $this->siswa_ibadah_harian()->delete();
        return parent::delete();
    }
}
