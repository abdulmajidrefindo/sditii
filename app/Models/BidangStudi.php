<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidangStudi extends Model
{
    use HasFactory;
    protected $table = "bidang_studis";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function tugas_mapel()
    {
        return $this->hasMany(TugasMapel::class);
    }
}
