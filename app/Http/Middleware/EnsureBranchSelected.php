<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureBranchSelected
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();


        if (!$user) {
            return $next($request);
        }

       
        if ($user->role_id == 1 && !session()->has('branch_id')) {

            if (!$request->is('dashboard')) {
                return redirect()->route('dashboard')
                    ->with('error', 'Choose another branch');
            }
        }

        return $next($request);
    }
}
