<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doa1 extends Model
{
    use HasFactory;
    protected $table = "doas_1";
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'nama_nilai',
        'guru_id',
        'kelas_id',
    ];

    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
