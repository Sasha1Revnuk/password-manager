<?php

namespace App\Http\Middleware;

use Closure;

class CheckNoteForUser
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
        $note = $request->route('note');

        if(!$user || !$note || !$user->notes->contains('id', $note->id)) {
            return abort(404);
        }
        return $next($request);
    }
}
