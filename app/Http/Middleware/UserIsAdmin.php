<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if($request->user()->admin == 0 || !$request->user()) {
			session()->flash('error','Nemáte administrátorský přístup.');

			return redirect('/dashboard');
		}

        return $next($request);
    }
}
