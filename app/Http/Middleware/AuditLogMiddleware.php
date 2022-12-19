<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AuditLogMiddleware
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
        try {
            $user = $request->user()->id;
            $endpoint = $request->url();
            $method = $request->method();
            $ip = $request->ip();

            if ($user != null && ! strpos($endpoint, 'metric')) {
                AuditLog::create([
                    'user_id' => $user,
                    'endpoint' => $endpoint,
                    'method' => $method,
                    'ip' => $ip,
                ]);
            }

            return $next($request);
        } catch (Exception $e) {
            return $next($request);
        }
    }
}
