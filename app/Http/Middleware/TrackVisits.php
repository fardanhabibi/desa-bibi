<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Illuminate\Support\Facades\Schema;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah tabel visits sudah ada
        if (auth()->check() && Schema::hasTable('visits')) {
            $user = auth()->user();
            
            // Catat visit user
            Visit::create([
                'user_id' => $user->id,
                'page' => $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
