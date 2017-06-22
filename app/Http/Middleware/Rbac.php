<?php

namespace App\Http\Middleware;

use Closure;
use Route,URL,Auth;

class Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect('login');
        }

        if (Auth::guard($guard)->user()->is_super) {
            return $next($request);
        }

        if (! Auth::guard($guard)->user()->can(Route::currentRouteName())) {
            if ($request->ajax() && ($request->getMethod() != 'GET')) {//post get 暂时分开写
                return response()->json(formatResponse('error', 'not_allow'));
            } elseif ( $request->ajax() ) {
                return response()->json(formatResponse('error', 'not_allow'));
            } else {
                abort(405, 'Unauthorized action Fuck Off.');
            }
        }

        return $next($request);
    }
}
