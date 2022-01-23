<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = ['pegawai_id', 'image', 'jam_masuk', 'jam_keluar'];
}
