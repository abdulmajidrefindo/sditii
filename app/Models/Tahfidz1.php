<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahfidz1 extends Model
{
    use HasFactory;
    protected $table = "tahfidzs_1";
    protected $guarded = ['id'];
    public $timestamps = true;
    
    protected $fillable = [
        'nama_nilai',
        'guru_id',
        'kelas_id',
    ];

    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class, 'tahfidz_1_id', 'id');
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
        $this->siswa_tahfidz()->delete();
        return parent::delete();
    }

}
