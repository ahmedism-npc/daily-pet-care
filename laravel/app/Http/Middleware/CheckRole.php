<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek apakah role user saat ini ada dalam array role yang diizinkan route
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin (role) untuk mengakses fitur ini.');
        }

        return $next($request);
    }
}
