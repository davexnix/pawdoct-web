<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|min:2|max:150',
            // 'email' => 'required|string|email|max:225|unique:users,email',
            'phone' => 'numeric',
            'gender' => 'string|in:male,female,other',
            'address' => 'string|min:5|max:225',
            // 'username' => 'required|string|min:6|max:30|unique:users,username',
            // 'password' => 'required|string|min:8|max:30|confirmed'
        ]);

        $updates = [];
        $allowed = ['name', 'phone', 'gender', 'address'];

        foreach ($allowed as $rkey) {
            if (isset($data[$rkey])) {
                $updates[$rkey] = $data[$rkey];
            }
        }

        if (empty($updates)) {
            return response()->json(['message' => 'Empty update request'], 400);
        }

        $doUpdate = $request->user()->update($updates);
        if ($doUpdate) {
            return response()->json($request->user()->refresh(), 200);
        }

        return response()->json(['message' => 'Failed to update data'], 500);
    }
}
