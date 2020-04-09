<?php

namespace App\Http\Middleware;

use App\Enumerators\ObjectEnumerator;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserID
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
        $user = $request->route('user');

        if(!$user || $user->id != Auth::user()->id) {
            return abort(404);
        }
        return $next($request);
    }
}
