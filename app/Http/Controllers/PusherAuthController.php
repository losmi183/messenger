<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Services\JWTServices;

class PusherAuthController extends Controller
{
    private JWTServices $jWTServices;
    public function __construct(JWTServices $jWTServices) {
        $this->jWTServices = $jWTServices;
    }

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

        $channel_name = $request->input('channel_name');
        $socket_id = $request->input('socket_id');
        
        $user = $this->jWTServices->getContent();
        $user_id = $user['id'];

        
        // Proveri da li korisnik sme da pristupa ovom kanalu
        if ($channel_name === "private-user-{$user_id}") {
            // Autorizuj pristup
            $auth = $pusher->socket_auth($channel_name, $socket_id);
            return response($auth);
        }
        
        // Odbaci pristup
        return response('Forbidden', 403);
    }
}