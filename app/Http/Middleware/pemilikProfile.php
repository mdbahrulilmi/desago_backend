<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class pemilikProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('id'); // Ambil ID dari parameter route
        $user = User::where('id','=',$userId)->first();
        if(!$user || $user->id !== Auth::id()){
            //dd(5);
            return response()->json([
                "success" => false,
                "message" => "Tidak memiliki izin untuk mengubah profile ini",
            ]);
        }
        //dd(6);
        return $next($request);
    }
}
