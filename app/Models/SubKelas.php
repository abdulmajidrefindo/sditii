<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKelas extends Model
{
    use HasFactory;
    protected $table = "sub_kelas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
