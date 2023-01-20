<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahfidz extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "tahfidz";
    protected $fillable = ['id_surat','nama_surat','id_guru'];
    public $timestamps = true;
}
