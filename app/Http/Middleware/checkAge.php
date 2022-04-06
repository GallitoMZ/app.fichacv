<?php

namespace App\Http\Middleware;

use Closure;

class checkAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->edad >= 18) {
            return $next($request); //permite que la solicitud http continue
        }else{
            return redirect('no-autorized');
        }
    }
}
