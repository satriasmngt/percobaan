<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan view login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan view register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/penduduk');
        }

        return back()->withErrors(['email' => 'Password anda salah']);
    }

    // Menangani proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255|confirmed',
        ],[
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => "Password harus diisi",
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Berhasil daftar');
    }

    // Menangani logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}