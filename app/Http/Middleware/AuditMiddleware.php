<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AuditLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuditMiddleware
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
        $methods = [
            'POST',
            'PUT',
            "DELETE",
        ];

        if (in_array($request->method(), $methods)) {
            $user = $request->user() ? $request->user()->id : null;

            $endpoint =  Str::replace("/nova-api", "/app/resources", $request->url());
            AuditLog::create([
                'user_id' => $user,
                'ip' => $request->ip(),
                'endpoint' => $endpoint,
                'method' => $request->method(),
            ]);
        }
        return $next($request);
    }
}
