<?php

namespace App\Http\Controllers;

// Import User model
use App\Models\User;

use Illuminate\Http\Request;

// Import response class
use Illuminate\Http\Response;

// Import hash class
use Illuminate\Support\Facades\Hash;

// Import auth class
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration of a new user
    public function register(Request $request)
    {
        // Validation
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // Create new user in the database
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // Create a unique token for this newly created user 
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Pack user data and the token as response variable
        $response = [
            'user' => $user,
            'token' => $token
        ];

        // Return the response packet above. 201 request is accepted (OK) and has  data as response 
        return response($response, 201);
    }

    // Log a user into the app
    public function login(Request $request)
    {
        // Validation
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check that the provided login email matches user email in the database
        $user = User::where('email', $fields['email'])->first();

        // Check that the provided login password matches the above user password
        if(!$user || !Hash::check($fields['password'], $user->password))
        {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Create a unique token for this newly created user 
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Pack user data and the token as response variable
        $response = [
            'user' => $user,
            'token' => $token
        ];

        // Return the response packet above. 201 request is accepted (OK) and has  data as response 
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        // Delete the logged-in User's token and session data
        auth('sanctum')->user()->currentAccessToken()->delete();

        // Message after logout
        return [
            'message' => 'You\'re logged out',
        ];
    }
}
