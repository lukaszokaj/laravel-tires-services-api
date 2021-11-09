<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AdminAuthRequest;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function login(AdminAuthRequest $request) {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid login credential.'
            ], 401);
        }

        $token = $user->createToken('Token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have been logged out'
        ];
    }
}
