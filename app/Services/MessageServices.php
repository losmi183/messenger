<?php

namespace App\Services;
use stdClass;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use App\Services\PusherServices;
use App\Repository\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repository\MessageRepository;

class MessageServices {

    private UserRepository $userRepository;
    private JWTServices $jwtServices;
    private MessageRepository $messageRepository;
    private PusherServices $pusherServices;
    public function __construct(UserRepository $userRepository, JWTServices $jwtServices, MessageRepository $messageRepository, PusherServices $pusherServices) {
        $this->userRepository = $userRepository;
        $this->jwtServices = $jwtServices;
        $this->messageRepository = $messageRepository;
        $this->pusherServices = $pusherServices;
    }

    public function conversation(int $friend_id): stdClass
    {
        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];

        $connection = DB::table('user_connections as c')
            ->where(function ($query) use ($user_id) {
                $query->where('c.initiator_id', $user_id)
                    ->orWhere('c.recipient_id', $user_id);
            })
            ->where(function ($query) use ($friend_id) {
                $query->where('c.initiator_id', $friend_id)
                    ->orWhere('c.recipient_id', $friend_id);
            })
            ->first();

        $connection->messages = DB::table('messages as m')
        ->select('m.*', 'u.name as sender_name', 'u2.name as reciver_name')
        ->leftJoin('users as u', 'm.sender_id', 'u.id')
        ->leftJoin('users as u2', 'm.receiver_id', 'u2.id')
        ->where(function ($q) use ($user_id, $friend_id) {
            $q->where('m.sender_id', $user_id)
            ->where('m.receiver_id', $friend_id);
        })
        ->orWhere(function ($q) use ($user_id, $friend_id) {
            $q->where('m.sender_id', $friend_id)
            ->where('m.receiver_id', $user_id);
        })
        // ->where('conversation_id', $conversation_id)
        ->orderBy('m.created_at', 'asc')
        ->get();

        return $connection;
    }

    public function send(int $recipient_id, string $content): Message
    {
        $user = $this->jwtServices->getContent();
        unset($user['exp']);
        $event = 'message.sent';

        $this->pusherServices->push($event, $recipient_id, $content, $user);

        try {
            $message = Message::create([
                'sender_id' => $user['id'],
                'receiver_id' => $recipient_id,
                'message' => $content,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return $message;
    }



    public function seen(int $friend_id, string $seen): bool
    {
        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];
        $event = 'message.seen';

        $pusher = new Pusher(
            config('pusher.key'),
            config('pusher.secret'),
            config('pusher.app_id'),
            [
                'cluster' => config('pusher.cluster'),
                'useTLS' => config('pusher.useTLS', true),
            ]
        );

        // Privatni kanal za korisnika recipient_id
        $pusher->trigger("private-user-{$friend_id}", $event, [
            'seen' => $seen
        ]);

        try {
            Message::where(function ($q) use ($user_id, $friend_id) {
            $q->where('sender_id', $friend_id)
            ->where('receiver_id', $user_id);
        })
        ->update([
            'seen' => Carbon::parse($seen)->toDateTimeString()
        ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return true;
    }

    public function markAsSeen(int $friend_id): bool
    {
        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];

        try {
            DB::table('messages')
                ->where('sender_id', $friend_id)
                ->where('receiver_id', $user_id)
                ->where('is_read', 0)
                ->update([
                    'status' => 'seen',
                    'is_read' => 1,
                    'seen' => now(),
                ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return true;
    }
}