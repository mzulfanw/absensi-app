<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $fillable = ['id', 'nomer_pegawai', 'nama_lengkap', 'tanggal_lahir', 'gender', 'image', 'divisi_id', 'alamat'];
}
