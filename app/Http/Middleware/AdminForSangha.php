<?php namespace App\Http\Middleware;

use Closure;

class AdminForSangha
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

        if (! $request->user()->sanghas->find($id)
            or 'administrator' !== $request->user()->roleForSangha($id)
        ) {
            return redirect('/sanghas');
        }

        return $next($request);
    }
}
