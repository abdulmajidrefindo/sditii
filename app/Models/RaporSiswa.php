<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaporSiswa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "rapor_siswa";
    protected $fillable = ['id_rapor','tempat','tanggal','id_siswa','id_siswa_mapel','id_siswa_iwr','id_siswa_ih','id_siswa_hadist','id_siswa_doa','nama_sekolah','id_periode','id_format'];
    public $timestamps = true;
}
