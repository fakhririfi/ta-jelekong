<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param   mixed ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('customer.events.index');
        }

        foreach ($roles as $role) {
            $user = User::where('id', auth()->user()->id)->first();
            if (count($user->hasRole($role)) == 1) {
                return $next($request);
            }
        }
        return redirect()->route('customer.events.index');
    }
}
