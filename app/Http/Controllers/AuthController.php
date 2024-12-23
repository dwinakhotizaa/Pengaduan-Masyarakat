<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showlogin()
{
    return view('login');
}


public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
        ]);

        if ($request->action == 'login') {
            $user = User::where('email', $request->email)->first();
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Kirim session flash sukses
                return redirect()->route('report.pengaduan')->with('success', 'Login berhasil!');
            } else {
                // Kirim session flash gagal
                return redirect()->back()->with('error', 'Email atau password salah.');
            }
        } else if ($request->action == 'register') {
            // Check if the user already exists
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                return redirect('login')->with('error', 'Email already exists');
            }

            // Register new user
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'GUEST', // Set role to 'GUEST' by default
            ]);

            // Automatically log the user in
            Auth::login($user);

            return redirect()->route('report.pengaduan')->with('success', 'Registration and Login Successful');
        }

    }


}
