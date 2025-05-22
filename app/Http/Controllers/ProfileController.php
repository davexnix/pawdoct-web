<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('profile', [
            'profile' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|min:2|max:150',
            'email' => [
                'required',
                'string',
                'email',
                'max:225',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'min:6',
                'max:30',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|numeric',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string|min:5|max:225',
        ]);

        $user->update($request->only([
            'name', 'username', 'email', 'phone', 'gender', 'address'
        ]));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
