<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswas";
    // protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'nisn',
        'nama_siswa',
        'orangtua_wali',
        'created_at',
        'updated_at',
        'sub_kelas_id',
        'periode_id',
        'rapor_siswa_id'
    ];


    public function sub_kelas()
    {
        // return with kelas data
        return $this->belongsTo(SubKelas::class, 'sub_kelas_id', 'id')->with('kelas');
    }

    public function rapor_siswa()
    {
        return $this->belongsTo(RaporSiswa::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    

    // Bidang Studi siswa
    public function siswa_bidang_studi()
    {
        return $this->hasMany(SiswaBidangStudi::class);
    }

    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }

    public function siswa_hadist()
    {
        return $this->hasMany(SiswaHadist::class);
    }

    public function siswa_ibadah_harian()
    {
        return $this->hasMany(SiswaIbadahHarian::class);
    }
    public function siswa_tahfidz()
    {
        return $this->hasMany(SiswaTahfidz::class);
    }
    public function ilman_waa_ruuhan()
    {
        return $this->hasMany(IlmanWaaRuuhan::class);
    }
    
    public function siswa_iwr()
    {
        return $this->hasMany(SiswaIlmanWaaRuuhan::class);
    }

    // On Delete
    // Note: Apabila siswa dihapus, maka data siswa yang berelasi dengan siswa akan ikut terhapus.
    public function delete()
    {
        $this->siswa_bidang_studi()->delete();
        $this->siswa_doa()->delete();
        $this->siswa_hadist()->delete();
        $this->siswa_ibadah_harian()->delete();
        $this->siswa_tahfidz()->delete();
        $this->siswa_iwr()->delete();
        return parent::delete();
    }
}
