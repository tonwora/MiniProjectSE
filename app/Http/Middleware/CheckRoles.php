<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // ตรวจสอบว่าผู้ใช้มีบทบาทที่ถูกต้องหรือไม่
        if ($request->user() && in_array($request->user()->roles, $roles)) {
            return $next($request);
        }

        return redirect('/');
    }
}
