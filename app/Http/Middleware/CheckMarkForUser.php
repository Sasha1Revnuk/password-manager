<?php

namespace App\Http\Middleware;

use Closure;

class CheckMarkForUser
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
        $mark = $request->route('mark');

        if(!$user || !$mark || !$user->marks->contains('id', $mark->id)) {
            return abort(404);
        }
        return $next($request);
    }
}
