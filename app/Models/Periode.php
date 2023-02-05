<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory;
    protected $table = "periodes";
    protected $guarded = ['id'];
    public $timestamps = true;
}
