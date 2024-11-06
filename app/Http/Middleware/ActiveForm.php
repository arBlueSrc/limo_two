<?php

namespace App\Http\Middleware;

use App\Models\SingleResult;
use Closure;
use Illuminate\Http\Request;

class ActiveForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $active = false;
        if ($active){
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
