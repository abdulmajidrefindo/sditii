<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hadist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "hadist";
    protected $fillable = ['id_hadist','nama_hadist','id_guru'];
    public $timestamps = true;
}
