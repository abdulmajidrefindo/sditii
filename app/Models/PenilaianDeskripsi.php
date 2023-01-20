<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenilaianDeskripsi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "penilaian_deskripsi";
    protected $fillable = ['deskripsi','keterangan'];
    public $timestamps = true;
}
