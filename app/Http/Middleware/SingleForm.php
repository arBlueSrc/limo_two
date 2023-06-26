<?php

namespace App\Http\Middleware;

use App\Models\SingleResult;
use Closure;
use Illuminate\Http\Request;

class SingleForm
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
        $user=auth()->user();
        $single_count = SingleResult::where('user_id',Auth()->user()->id)->count();
        if ($single_count>=3){
        return redirect()->route('show_form');
        }
        else {
            return $next($request);
        }
    }
}
