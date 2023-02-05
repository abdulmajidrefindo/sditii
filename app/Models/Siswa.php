<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswas";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
