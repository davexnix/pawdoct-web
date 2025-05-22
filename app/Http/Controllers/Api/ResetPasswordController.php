<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'email|required|email|exists:users,email'
        ]);

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return "pawdoctapp://reset-password/$token?email=" . urlencode($user->email);
        });

        $status = Password::sendResetLink($request->only('email'));

        $code = 200;
        if ($status === Password::ResetThrottled) {
            $code = 429;
        }

        return response()->json(['message' => __($status)], $code);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:30|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        $code = 500;
        if ($status === Password::InvalidToken || $status === Password::InvalidUser) {
            $code = 400;
        } elseif ($status === Password::PasswordReset) {
            $code = 200;
        }

        return response()->json(['message' => __($status)], $code);
    }
}
