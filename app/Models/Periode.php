<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "periode";
    protected $fillable = ['tahun_ajaran','semester'];
    public $timestamps = true;
}
