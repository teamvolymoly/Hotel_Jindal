<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid admin credentials.',
                'errors' => [
                    'email' => ['Invalid admin credentials.'],
                ],
            ], 422);
        }

        if (! $user->is_admin) {
            return response()->json([
                'message' => 'This account does not have admin access.',
            ], 403);
        }

        $plainTextToken = Str::random(80);

        $token = ApiToken::create([
            'user_id' => $user->id,
            'name' => 'admin-api',
            'token_hash' => hash('sha256', $plainTextToken),
            'last_used_at' => now(),
        ]);

        return response()->json([
            'message' => 'Login successful.',
            'token' => $plainTextToken,
            'token_type' => 'Bearer',
            'user' => (new UserResource($user))->resolve(),
            'meta' => [
                'token_id' => $token->id,
            ],
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json([
            'data' => (new UserResource(request()->user()))->resolve(),
        ]);
    }

    public function destroy(): JsonResponse
    {
        $token = request()->attributes->get('current_api_token');

        if ($token instanceof ApiToken) {
            $token->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
