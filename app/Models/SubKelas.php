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
    //set primary key
    protected $primaryKey = 'id';

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    
    // on delete
    public static function boot() {
        parent::boot();

        static::deleting(function($sub_kelas) {
            $sub_kelas->siswa()->delete();
        });
    }
}
