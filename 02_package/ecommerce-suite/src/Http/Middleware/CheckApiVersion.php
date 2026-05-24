<?php

namespace MaksimYurash\EcommerceSuite\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiVersion
{
    public function handle(Request $request, Closure $next, ?string $routeVersion = null): Response
    {
        $header = $request->header('X-API-VERSION');
        $expected = $routeVersion ?: $this->routeVersion($request) ?: (string) config('ecommerce-suite.default_api_version', 1);

        if ($header === null || $header === '') {
            return response()->json([
                'message' => 'Header X-API-VERSION is required.',
                'expected_version' => (int) $expected,
            ], 400);
        }

        if (!ctype_digit((string) $header)) {
            return response()->json([
                'message' => 'Header X-API-VERSION must contain only numeric value.',
            ], 400);
        }

        if ((int) $header !== (int) $expected) {
            return response()->json([
                'message' => 'Unsupported API protocol version.',
                'expected_version' => (int) $expected,
                'received_version' => (int) $header,
            ], 426);
        }

        return $next($request);
    }

    private function routeVersion(Request $request): ?string
    {
        $route = $request->route();
        if (!$route) {
            return null;
        }

        foreach ($route->gatherMiddleware() as $middleware) {
            if (is_string($middleware) && str_starts_with($middleware, 'ecommerce.api.version:')) {
                return substr($middleware, strlen('ecommerce.api.version:'));
            }
        }

        return null;
    }
}
