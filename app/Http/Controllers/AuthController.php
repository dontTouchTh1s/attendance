<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $attempt = Auth::attempt($credentials);

        if (!$attempt) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized, user name or password in wrong.',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'workPlace' => $user->employee->groupPolicy->workPlace
        ]);

    }

    public function user()
    {
        $response = null;
        Auth::check() ? $response = response(Auth::user()) : $response = response('No authenticated', 401);
        return $response;

    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


}
