<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PegawaiiController extends Controller
{
    //
    public function index()
    {
        $pegawai = DB::table('pegawai')->join('divisi', 'pegawai.divisi_id', '=', 'divisi.id')->select('pegawai.*', 'divisi.job')->get();
        $divisi = Divisi::all();
        return view('Dashboard.Pegawai.index', compact('pegawai', 'divisi'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'nomer_pegawai' => 'unique:pegawai,nomer_pegawai'
        ]);

        $pegawaiID = $request->id;
        $details = [
            'nomer_pegawai' => $request->nomerpegawai,
            'nama_lengkap' => $request->namalengkap,
            'tanggal_lahir' => $request->tanggallahir,
            'gender' => $request->gender,
            'divisi_id' => $request->divisi_id,
            'alamat' => $request->alamat
        ];

        if ($files = $request->file('gambar')) {
            // File::delete('assets/images/pegawai/', $request->gambar);

            $destinasiFile = public_path() . '/assets/images/pegawai/';
            $pegawaiPicture = time() . '' . $files->getClientOriginalExtension();
            $files->move($destinasiFile, $pegawaiPicture);
            $details["image"] = "$pegawaiPicture";
        }

        Pegawai::updateOrCreate(['id' => $pegawaiID], $details);
        return response()->json([
            'success' => 'Succesfully',
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $model = Pegawai::findOrFail($id);
        return Response::json($model);
    }

    public function destroy(Request $request, $id)
    {
        $data = Pegawai::findOrFail($id);
        $data->delete();
        return redirect()->back();
    }
}
