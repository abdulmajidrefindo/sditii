<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TugasMapel extends Model
{
    use HasFactory;
    protected $table = "tugas_mapels";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function bidang_studi()
    {
        return $this->belongsTo(BidangStudi::class);
    }
    public function siswa_mapel()
    {
        return $this->hasMany(SiswaMapel::class);
    }
}
