<?php namespace App\Http\Middleware;

use Closure;

class OwnerOfProfile
{

    /**
     * Redirect if the user making the request is not the owner of the profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->segment(2);

        if (! ($request->user()->id == $id)) {
            return redirect('/users');
        }

        return $next($request);
    }
}
