<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doa extends Model
{
    use HasFactory;
    protected $table = "doas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function siswa_doa()
    {
        return $this->hasMany(SiswaDoa::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
