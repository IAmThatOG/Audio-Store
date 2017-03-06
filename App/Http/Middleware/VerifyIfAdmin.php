<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIfAdmin
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
        //get then user making the request
        $user = $request->user();

        if($user && $user->role == 'admin')
            return $next($request);
//        return view('errors.401');
//        abort(404, 'Unauthorized');
        return back();
    }
}
