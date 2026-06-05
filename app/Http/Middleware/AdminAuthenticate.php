<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $admin = \App\Models\Admin::find(session('admin_id'));
        if (!$admin || !$admin->is_active) {
            $request->session()->forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_name', 'admin_role']);
            return redirect()->route('admin.login')
                ->with('error', 'Sesi telah berakhir atau akun Anda dinonaktifkan.');
        }

        // Membagikan admin yang sedang login ke seluruh views
        \Illuminate\Support\Facades\View::share('currentAdmin', $admin);

        return $next($request);
    }
}
