<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaBidangStudi extends Model
{
    use HasFactory;
    protected $table = "siswa_bidang_studis";
    protected $fillable = ['id',
        'siswa_id',
        'mapel_id',
        'nilai_uh_1',
        'nilai_uh_2',
        'nilai_uh_3',
        'nilai_uh_4',
        'nilai_tugas_1',
        'nilai_tugas_2',
        'nilai_uts',
        'nilai_pas',
        'profil_sekolah_id',
        'periode_id',
        'rapor_siswa_id',
        'nilai_akhir'
    ];
        
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function nilai_uh_1()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_uh_1', 'id');
    }
    public function nilai_uh_2()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_uh_2', 'id');
    }
    public function nilai_uh_3()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_uh_3', 'id');
    }
    public function nilai_uh_4()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_uh_4', 'id');
    }
    public function nilai_tugas_1()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_tugas_1', 'id');
    }
    public function nilai_tugas_2()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_tugas_2', 'id');
    }
    public function nilai_uts()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_uts', 'id');
    }
    public function nilai_pas()
    {
        return $this->belongsTo(PenilaianHurufAngka::class, 'nilai_pas', 'id');
    }

    public function rapor_siswa()
    {
        return $this->belongsTo(RaporSiswa::class);
    }
    public function profil_sekolah()
    {
        return $this->belongsTo(ProfilSekolah::class);
    }
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

}
