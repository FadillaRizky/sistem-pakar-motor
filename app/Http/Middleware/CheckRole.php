<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kalau belum login → paksa ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Amankan kalau kolom role null
        if (empty($user->role)) {
            // anggap user biasa
            $userRole = 'user';
        } else {
            $userRole = $user->role;
        }

        // Kalau role cocok dengan yang diminta di route → lanjut
        if (in_array($userRole, $roles, true)) {
            return $next($request);
        }

        // Kalau bukan role yang diminta:
        // Admin → paksa ke /admin/dashboard
        if ($userRole === 'admin') {
            if (!$request->routeIs('admin.dashboard')) {
                return redirect()->route('admin.dashboard');
            }

            return $next($request);
        }

        // User biasa → paksa ke /dashboard
        if ($userRole === 'user') {
            if (!$request->routeIs('dashboard')) {
                return redirect()->route('dashboard');
            }

            return $next($request);
        }

        // Kalau role tidak dikenal, jangan loop ke login.
        // Biarkan lanjut dulu (nanti bisa di-handle di tempat lain).
        return $next($request);
    }
}
