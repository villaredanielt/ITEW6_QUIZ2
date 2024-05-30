<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validationRules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ];

            $customMessages = [
                'email.unique' => 'This email address is already in use.',
                'password.min' => 'Your password needs to be at least 6 characters long.',
                'password.confirmed' => 'Password confirmation does not match.',
                'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ];

            $request->validate($validationRules, $customMessages);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'message' => 'Account created',
                'method' => 'POST'
            ], 201);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
