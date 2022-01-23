<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = Auth::attempt(['email' => $username, 'password' => $password]);
        if (!$user) {
            Session::flash('gagal', 'Your account doesnt match with our database');
            return back();
        }
        return redirect()->route('admin.dashboard');
    }
}