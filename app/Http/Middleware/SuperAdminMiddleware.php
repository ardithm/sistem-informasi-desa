<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== 'super_admin') {
            abort(403, 'Akses terbatas. Halaman ini hanya dapat diakses oleh Super Administrator.');
        }

        return $next($request);
    }
}
