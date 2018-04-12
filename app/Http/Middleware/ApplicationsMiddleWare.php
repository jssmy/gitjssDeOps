<?php

namespace GitScrum\Http\Middleware;

use Closure;
use Auth;
class ApplicationsMiddleWare
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
   

        //dd(Auth::user());
        if (!(Auth::user()->github && Auth::user()->trello))
        {
            return redirect()->route('config.application');
        }


        return $next($request);
    }
}


