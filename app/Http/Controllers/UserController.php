<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function ubahProfil(Request $request)
    {
        Auth::user()->update([
            'name' => $request->nama,
            'email' => $request->email
        ]);

        return back()->with('message', 'Profil berhasil diganti');
    }

    public function ubahPassword(Request $request)
    {
        if (Hash::check($request->konfirmasi_password, Auth::user()->password)){
            Auth::user()->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return back()->with('message', 'Password berhasil diganti');
    }
}
