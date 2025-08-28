<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $pusher = new Pusher(
            config('pusher.key'),
            config('pusher.secret'),
            config('pusher.app_id'),
            [
                'cluster' => config('pusher.cluster'),
                'useTLS' => config('pusher.useTLS', true),
            ]
        );

        $channelName = $request->input('channel_name');
        $socketId = $request->input('socket_id');
        
        // Za sada hardkoduj da je user ID 1
        $userId = 1;
        
        // Proveri da li korisnik sme da pristupa ovom kanalu
        if ($channelName === "private-user-{$userId}") {
            // Autorizuj pristup
            $auth = $pusher->socket_auth($channelName, $socketId);
            return response($auth);
        }
        
        // Odbaci pristup
        return response('Forbidden', 403);
    }
}