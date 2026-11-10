<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /* =========================
           BELUM LOGIN
        ========================== */

        if (!auth()->check()) {

            return redirect()
                ->route('user.login')
                ->withErrors([
                    'username' => 'Silahkan login terlebih dahulu.'
                ]);
        }


        /* =========================
           BUKAN ADMIN
        ========================== */

        if (auth()->user()->role !== 'admin') {

            abort(403, 'Akses hanya diperbolehkan untuk admin.');
        }


        /* =========================
           ADMIN
        ========================== */

        return $next($request);
    }
}