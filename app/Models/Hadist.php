<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hadist extends Model
{
    use HasFactory;
    protected $table = "hadists";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function siswa_hadist()
    {
        return $this->hasMany(SiswaHadist::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
