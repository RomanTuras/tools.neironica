<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;

class CheckIsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new User();
        $role = $user->getRole();
        if ($role == "teacher") {
            return $next($request);
        }
        return redirect('/');
    }
}
