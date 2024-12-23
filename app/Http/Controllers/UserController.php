<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class UserController extends Controller
{
    
    public function index()
{
    $users = User::all();
    dd($users); // This will dump all user data to the screen
    return view('staffhead.akun', compact('users'));
}

    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => "required|email|unique:users",
            'password' => "required|min:6",
            'role' => "required"
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('akun.data')->with('success', 'User berhasil ditambah.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('akun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => "required|email|unique:users,email,$id",
            'password' => "nullable|min:6",
            'role' => "required"
        ]);

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role
        ]);

        return redirect()->route('akun.data')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('akun.data')->with('success', 'User berhasil dihapus.');
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new UserExport, 'rekap-akun.xlsx');
    // }
}
