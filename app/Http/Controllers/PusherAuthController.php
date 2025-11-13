<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Services\JWTServices;
use Illuminate\Support\Facades\Log;

class PusherAuthController extends Controller
{
    private JWTServices $jWTServices;
    public function __construct(JWTServices $jWTServices) {
        $this->jWTServices = $jWTServices;
    }

    public function authenticate(Request $request)
    {
        // $pusher = new Pusher(
        //     config('pusher.key'),
        //     config('pusher.secret'),
        //     config('pusher.app_id'),
        //     [
        //         'cluster' => config('pusher.cluster'),
        //         'useTLS' => config('pusher.useTLS', true),
        //     ]
        // );
        $pusher = new Pusher(
            'd842d9bd852a8bbc74b0',
            '19954d590e875e506b86',
            '1821016',
            [
                'cluster' => 'eu',
                'useTLS' => true,
            ]
        );

        Log::info('$pusher');
        Log::info(json_encode($pusher));
        
        $channel_name = $request->input('channel_name');
        Log::info('$channel_name');
        Log::info($channel_name);
        $socket_id = $request->input('socket_id');
        Log::info('$socket_id');
        Log::info($socket_id);
        
        $user = $this->jWTServices->getContent();
        $user_id = $user['id'];
        Log::info('$user_id');
        Log::info($user_id);

        
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