<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilSekolah extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "profil_sekolah";
    protected $fillable = ['nama_sekolah','alamat_sekolah','email_sekolah','kontak_sekolah','website_sekolah'];
    public $timestamps = true;
}
