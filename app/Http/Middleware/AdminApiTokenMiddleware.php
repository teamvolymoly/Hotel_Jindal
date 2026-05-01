<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $sessionUser = $request->user();

        if ($sessionUser?->is_admin) {
            return $next($request);
        }

        $plainTextToken = $request->bearerToken();

        if (! $plainTextToken) {
            return new JsonResponse([
                'message' => 'Authentication token is required.',
            ], 401);
        }

        $token = ApiToken::with('user')
            ->where('token_hash', hash('sha256', $plainTextToken))
            ->first();

        if (! $token || ! $token->user || ($token->expires_at && $token->expires_at->isPast())) {
            return new JsonResponse([
                'message' => 'Invalid or expired authentication token.',
            ], 401);
        }

        if (! $token->user->is_admin) {
            return new JsonResponse([
                'message' => 'This account does not have admin access.',
            ], 403);
        }

        $request->setUserResolver(fn () => $token->user);
        $request->attributes->set('current_api_token', $token);

        $token->forceFill([
            'last_used_at' => now(),
        ])->save();

        return $next($request);
    }
}
