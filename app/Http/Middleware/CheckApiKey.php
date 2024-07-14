<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApiKey;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');

        $user = ApiKey::where('key', $apiKey)->first()?->user;

        if (!$user) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
