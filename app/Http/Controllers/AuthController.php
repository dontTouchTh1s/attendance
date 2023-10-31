<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
                'status' => 401,
                'message' => 'Unauthorized, user name or password in wrong.',
            ]);
        }

        $user = Auth::user();
        if ($user->employee != null) {
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'workPlace' => $user->employee->groupPolicy->workPlace
            ]);
        } else {
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }

    }

    public function user()
    {
        Auth::check() ? $response = response(Auth::user()) : $response = response('No authenticated', 401);
        return $response;

    }

    public function employee()
    {
        return response(Auth::user()->employee);
    }

    public function groupPolicy()
    {
        return response(Auth::user()->employee->groupPolicy);
    }

    public function workPlace()
    {
        return response(Auth::user()->employee->groupPolicy->workPlace);
    }


    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Cookie::queue(Cookie::forget('is_auth'));
        return new Response('Logout');
    }


}
