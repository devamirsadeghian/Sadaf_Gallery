<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->is_admin != 1) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید. این قسمت برای ادمین یا مدیر سایت میباشد');

        }
        return $next($request);

    }
}
