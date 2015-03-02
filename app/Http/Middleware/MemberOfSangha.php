<?php namespace App\Http\Middleware;

use Closure;

class MemberOfSangha
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
        $id = $request->segment(2);

        if (! $request->user()->sanghas->find($id)) {
            return redirect('/sanghas');
        }

        return $next($request);
    }
}
