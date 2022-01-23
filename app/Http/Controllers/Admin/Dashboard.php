<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Divisi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //
    public function index()
    {
        $pegawai = Pegawai::count();
        $divisi = Divisi::count();
        $absensi = Absen::count();
        return view('Dashboard.index', [
            'pegawai' => $pegawai,
            'divisi' => $divisi,
            'absensi' => $absensi
        ]);
    }
}
