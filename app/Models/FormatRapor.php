<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormatRapor extends Model
{
    use HasFactory;
    use SoftDeletes;
    //protected $table = "format_rapor";
    //protected $fillable = ['id_format','format','id_kelas'];
    public $timestamps = true;
}
