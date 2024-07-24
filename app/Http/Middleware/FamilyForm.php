<?php

namespace App\Http\Middleware;

use App\Models\FamilyResult;
use App\Models\GroupResult;
use App\Models\SingleResult;
use Closure;
use Illuminate\Http\Request;

class FamilyForm
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
        $family = FamilyResult::where('user_id', Auth()->user()->id)->get()->count();
        if ($family!=0){
            return redirect()->route('home');
        }
        else {
            return $next($request);
        }
    }
}
