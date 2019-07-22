<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            // opción 1
            abort(403, "No tienes autorización para ingresar.");
            // Opción 2
//            return redirect('home');
        }
        return $next($request);
    }
}
