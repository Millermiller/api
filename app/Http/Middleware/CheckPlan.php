<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use Carbon\Carbon;
use Closure;

class CheckPlan
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
        if (\Auth::check()) {
            // The user is logged in...
            $user = \Auth::user();
            if(Carbon::parse($user->active_to) < Carbon::now()){
                $plan = Plan::where('name', 'Basic')->first()->id;
                $user->plan()->associate($plan);
                $user->save();
            }
        }
        return $next($request);
    }
}
