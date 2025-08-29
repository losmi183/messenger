<?php

namespace App\Services;
use Pusher\Pusher;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
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
    public function __construct(UserRepository $userRepository, JWTServices $jwtServices, MessageRepository $messageRepository) {
        $this->userRepository = $userRepository;
        $this->jwtServices = $jwtServices;
        $this->messageRepository = $messageRepository;
    }

    public function conversation(int $friend_id): Collection
    {
        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];

        $messages = DB::table('messages as m')
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
        ->orderBy('m.created_at', 'asc')
        ->get();

        return $messages;
    }

    public function send(int $recipient_id, string $content): bool
    {
        $user = $this->jwtServices->getContent();
        unset($user['exp']);
        $event = 'message.sent';

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
        $pusher->trigger("private-user-{$recipient_id}", $event, [
            'message' => $content,
            'from' => $user,
        ]);

        try {
            Message::create([
                'sender_id' => $user['id'],
                'receiver_id' => $recipient_id,
                'message' => $content,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return true;
    }
}