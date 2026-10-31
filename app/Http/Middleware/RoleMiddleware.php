<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {

        // Jika belum login, pergi ke halaman login StudySpace
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Semak peranan pengguna
        if (Auth::user()->role !== $role) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}