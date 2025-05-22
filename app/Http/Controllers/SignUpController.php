<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:150',
            'email' => 'required|string|email|max:225',
            'phone' => 'required|numeric',
            'gender' => 'required|string|in:male,female,other',
            // 'address' => 'required|string|min:5|max:225',
            'username' => 'required|string|min:6|max:30',
            'password' => 'required|string|min:8|max:30|confirmed'
        ]);

        $check = User::where('email', $request->email)->first();
        if ($check) {
            return back()->withInput()->withErrors(['email' => 'Email address already registred']);
        }

        $check = User::whereRaw('lower(username) = ?', [strtolower($request->username)])->first();
        if ($check) {
            return back()->withInput()->withErrors(['username' => 'Username address already registred']);
        }

        $user = User::create($data);
        event(new Registered($user));

        return redirect()->route('login')->with('register', 'Success, please login to your account!');
    }
}
