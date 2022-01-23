<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = DB::table('pegawai')
            ->join('absensi', 'pegawai.id', '=', 'absensi.pegawai_id')
            ->join('divisi', 'divisi.id', '=', 'pegawai.divisi_id')
            ->select('pegawai.nama_lengkap', 'pegawai.nomer_pegawai', 'divisi.job', 'absensi.image', 'absensi.jam_masuk', 'absensi.jam_keluar')
            ->get();

        return view('Dashboard.Absensi.index', compact('data'));
    }


    public function cetak()
    {
        $data = DB::table('pegawai')
            ->join('absensi', 'pegawai.id', '=', 'absensi.pegawai_id')
            ->join('divisi', 'divisi.id', '=', 'pegawai.divisi_id')
            ->select('pegawai.nama_lengkap', 'pegawai.nomer_pegawai', 'divisi.job', 'absensi.image', 'absensi.jam_masuk', 'absensi.jam_keluar')
            ->get();

        $pdf = PDF::loadview('Dashboard.Pegawai.pegawai_pdf', ['data' => $data]);
        return $pdf->download('laporan-pegawai.pdf');
    }
}
