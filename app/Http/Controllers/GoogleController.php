<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Google_Client;
use Illuminate\Http\Request;
use App\Models\User;

class GoogleController extends Controller
{
    public function login(Request $request)
    {
        $idToken = $request->input('id_token');
        if (!$idToken) return response()->json(['error' => 'Missing ID token'], 400);

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID_WEB')]);
        $payload = $client->verifyIdToken($idToken);

        if (!$payload) return response()->json(['error' => 'Invalid token'], 401);

        $googleId = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'] ?? '';

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => bcrypt(str()->random(32)),
                'google_id' => $googleId
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
}
