<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckIsStudent
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
        $user = new User();
        $role = $user->getRole();
        if ($role == "student") {
            return $next($request);
        }
        return redirect('/');
    }
}
