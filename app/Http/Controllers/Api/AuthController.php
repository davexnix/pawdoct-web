<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    private JWTGuard $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('api');
    }

    public function me()
    {
        return response()->json($this->guard->user());
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:6|max:225', // username / email
            'password' => 'required|string|min:8|max:30'
        ]);

        $credentials = [
            'password' => $request->password,
        ];

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$loginType] = $request->username;

        $user = User::where($loginType, $request->username)->first();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$token = $this->guard->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($user, $token);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:150',
            'email' => 'required|string|email|max:225',
            'phone' => 'required|numeric',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string|min:5|max:225',
            'username' => 'required|string|min:6|max:30',
            'password' => 'required|string|min:8|max:30|confirmed'
        ]);

        $check = User::where('email', $request->email)->first();
        if ($check) {
            return response()->json(['message' => 'Email address already registred'], 400);
        }

        $check = User::whereRaw('lower(username) = ?', [strtolower($request->username)])->first();
        if ($check) {
            return response()->json(['message' => 'Username address already registred'], 400);
        }

        $user = User::create($data);

        event(new Registered($user));

        return response()->json(['message' => 'User registred successfully'], 201);
    }

    public function refresh(Request $request)
    {
        return $this->respondWithToken($request->user(), $this->guard->refresh());
    }

    public function logout()
    {
        $this->guard->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    private function respondWithToken(User $user, string $token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $this->guard->factory()->getTTL() * 60,
            'user' => $user->toArray(),
        ]);
    }
}
