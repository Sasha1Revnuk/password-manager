<?php

namespace App\Http\Middleware;

use Closure;

class CheckWebGroupsForUser
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
        $group = $request->route('group');
        if(!$user || !$group || !$user->webGroups->contains('id', $group->id)) {
            return abort(404);
        }
        return $next($request);
    }
}
