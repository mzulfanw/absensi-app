<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    public function index()
    {


        return view('Pegawai');
    }


    public function store(Request $request)
    {
        $username = $request->nomer_pegawai;
        $password = $request->nama;

        $login = DB::select("select * from pegawai where nomer_pegawai='$username' and nama_lengkap='$password'");

        if ($login) {
            foreach ($login as $value) {
                Session::put('nama_lengkap', $value->nama_lengkap);
                Session::put('nomer_pegawai', $value->nomer_pegawai);
                $pegawaiId = $value->id;
                $img = $request->get('image');
                $folderPaths = public_path('/assets/images/absen/');
                $image_parts = explode(";base64,", $img);

                foreach ($image_parts as $key => $value) {
                    $image_base64 = base64_decode($value);
                }
                $fileName = time() . '.png';
                $file = $folderPaths . $fileName;
                file_put_contents($file, $image_base64);

                Absen::create([
                    'pegawai_id' => $pegawaiId,
                    'image' => $fileName,
                    'jam_masuk' => Carbon::now()
                ]);
            }
            return redirect()->route('pegawai.absen2');
        } else {
            return redirect()->back();
        }
    }

    public function index2()
    {
        // Absen::create([
        //     'pegawai_id' => $pegawaiId,
        //     'image' => $fileName,
        //     'jam_masuk' => Carbon::now()
        // ]);
        // dd(Session::get('nama_lengkap'));
        // $data = DB::table('pegawai')->join('absensi', 'pegawai.id', '=', 'absensi.pegawai_id')
        //     ->where('pegawai.nomer_pegawai', '=', Session::get('nomer_pegawai'))->get();
        // dd($data);
        return view('PegawaiK');
    }


    public function keluar($nomer_pegawai)
    {
        $nomer = $nomer_pegawai;

        $update = DB::table('pegawai')->join('absensi', 'pegawai.id', 'absensi.pegawai_id')
            ->where('pegawai.nomer_pegawai', '=', $nomer)->update(['absensi.jam_keluar' => Carbon::now()]);
        return redirect()->route('absen.pegawai');
    }
}
