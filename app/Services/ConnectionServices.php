<?php

namespace App\Services;
use App\Models\User;
use App\Models\Connection;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class ConnectionServices {

    private UserRepository $userRepository;
    private JWTServices $jwtServices;

    public function __construct(UserRepository $userRepository, JWTServices $jwtServices) {
        $this->userRepository = $userRepository;
        $this->jwtServices = $jwtServices;
    }

   
    public function initiate(int $recipient_id): Connection
    {
        $initiator = $this->jwtServices->getContent();

        // Check if user is already have connection
        $connection = DB::table('user_connections')
            ->where('initiator_id', $initiator['id'])
            ->where('recipient_id', $recipient_id)
            ->first();

        // 1 connection not exsists
        if ($connection) {
            abort(403, 'Connection already exsists');
        }

        try {
            $connection = Connection::create([
                'initiator_id' => $initiator['id'],
                'recipient_id' => $recipient_id
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            abort(response()->json(['error' => 'Database error'], 500));
        }

        return $connection;
    }  

    public function accept(int $connection_id): Connection
    {
        $recipient = $this->jwtServices->getContent();

        try {
            $connection = Connection::where('id', $connection_id)
                ->where('recipient_id', $recipient['id'])
                ->where('is_accepted', 0)
                ->update([
                    'is_accepted' => true,
                    'accepted_at' => now(),
                ]);

            if (!$connection) {
                abort(response()->json(['error' => 'Connection not found'], 404));
            }

            return Connection::find($connection_id);
        } catch (QueryException $e) {
            Log::error("DB error in accept(): " . $e->getMessage());
            abort(response()->json(['error' => 'Database error: ' . $e->getMessage()], 500));
        }
    }

    public function reject(int $connection_id):bool
    {
        $recipient = $this->jwtServices->getContent();

        try {
            $deleted = Connection::where('id', $connection_id)
                ->where('recipient_id', $recipient['id'])
                ->delete();

            if (!$deleted) {
                abort(response()->json(['error' => 'Connection not found'], 404));
            }

            return true;
        } catch (QueryException $e) {
            Log::error("DB error in reject(): " . $e->getMessage());
            abort(response()->json(['error' => 'Database error: ' . $e->getMessage()], 500));
        }
    }
}