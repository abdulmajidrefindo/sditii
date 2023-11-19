<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadist1 extends Model
{
    use HasFactory;
    protected $table = "hadists_1";
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'nama_nilai',
        'guru_id',
        'kelas_id',
    ];

    public function siswa_hadist()
    {
        return $this->hasMany(SiswaHadist::class, 'hadist_1_id', 'id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function delete()
    {
        $this->siswa_hadist()->delete();
        return parent::delete();
    }
}
