<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Nama pengguna atau kata sandi yang anda masukkan salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
