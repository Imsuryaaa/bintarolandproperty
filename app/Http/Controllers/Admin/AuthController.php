<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = \App\Models\Admin::where('username', $request->username)->first();

        if ($admin && \Illuminate\Support\Facades\Hash::check($request->password, $admin->password)) {
            if (!$admin->is_active) {
                return back()
                    ->withInput(['username' => $request->username])
                    ->withErrors(['username' => 'Akun Anda telah dinonaktifkan.']);
            }

            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('admin_username', $admin->username);
            $request->session()->put('admin_name', $admin->name);
            $request->session()->put('admin_role', $admin->role);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali, ' . $admin->name . '!');
        }

        return back()
            ->withInput(['username' => $request->username])
            ->withErrors(['password' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_name', 'admin_role']);
        $request->session()->regenerate();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
