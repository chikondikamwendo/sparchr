<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class LoginController
{
    public function __invoke(LoginRequest $request): JsonResponse {
        $validated = $request->validated();

        $user = User::firstWhere('email', $validated['email']);

        if (!$user || !Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        return Response::json(UserResource::make($user));
    }
    
}