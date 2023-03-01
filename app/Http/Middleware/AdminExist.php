<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminExist
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('isAdmin', '=', 1)->count();
        if ($user == 0) {
            return redirect('/admin/login');
        }
//        if (!Auth::check()) {
//            return redirect('/admin/login');
//        }
        return $next($request);
    }
}
