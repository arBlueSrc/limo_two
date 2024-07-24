<?php

namespace App\Http\Middleware;

use App\Models\GroupResult;
use App\Models\SingleResult;
use Closure;
use Illuminate\Http\Request;

class GroupForm
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
        $group = GroupResult::where('user_id', Auth()->user()->id)->get()->count();
        if ($group>=1){
            return redirect()->route('home');
        }
        else {
            return $next($request);
        }
    }
}
