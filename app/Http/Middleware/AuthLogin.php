<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('api_token');
        $tokenStartTime = session('token_start_time');

        // Eğer token yoksa ya da süresi dolduysa giriş sayfasına yönlendir
        if (!$token || !$tokenStartTime || Carbon::parse($tokenStartTime)->diffInSeconds(Carbon::now()) > 600) {
            session()->forget(['api_token', 'token_start_time']);
            return redirect('/login')->withErrors(['token_expired' => 'Oturum süresi doldu, lütfen yeniden giriş yapın.']);
        }

        return $next($request);
    }
}
