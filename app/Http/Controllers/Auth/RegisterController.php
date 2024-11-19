<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Tampilkan halaman register
    }

    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard
        return redirect()->route('dashboard');
    }
}
