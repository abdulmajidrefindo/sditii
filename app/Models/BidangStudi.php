<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidangStudi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "mapel";
    protected $fillable = ['id_mapel','nama_guru','id_guru'];
    public $timestamps = true;
}
