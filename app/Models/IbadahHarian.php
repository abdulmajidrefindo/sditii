<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IbadahHarian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "ibadah_harian";
    protected $fillable = ['id_kriteria','nama_kriteria','id_guru'];
    public $timestamps = true;
}
