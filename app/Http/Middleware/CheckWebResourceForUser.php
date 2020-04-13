<?php

namespace App\Http\Middleware;

use Closure;

class CheckWebResourceForUser
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
        $resource = $request->route('resource');

        if(!$user || !$resource || !$user->webResources('id', $resource->id)) {
            return abort(404);
        }
        return $next($request);
    }
}
