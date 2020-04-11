<?php

namespace App\Http\Middleware;

use Closure;

class CheckWebForUser
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
        $web = $request->route('web');

        if(!$user || !$web || !$user->webs->contains('id', $web->id)) {
            return abort(404);
        }
        return $next($request);
    }
}
