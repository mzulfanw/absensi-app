<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class DivisiController extends Controller
{
    //
    public function index()
    {
        $divisi = Divisi::all();
        return view('Dashboard.Divisi.index', compact('divisi'));
    }


    public function store(Request $request)
    {
        $id = $request->id;
        $model = Divisi::updateOrCreate(['id' => $id], ['job' => $request->job]);

        return response()->json($model, 200);
    }

    public function edit($id)
    {
        $model = Divisi::findOrFail($id);
        return Response::json($model);
    }

    public function destroy($id)
    {
        $id = Divisi::findOrFail($id);

        $id->delete();
        return redirect()->back();
    }
}
