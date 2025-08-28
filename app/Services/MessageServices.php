<?php

namespace App\Services;
use App\Models\User;
use App\Events\MessageSent;
use App\Repository\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

    // public function send(array $data): int
    // {
    //     // 1. sand message to reciver via web socket to client 
    //     event(new MessageSent($data['message'], $data['receiver_id']));
    //     // broadcast(new MessageSent($data['message'], $data['receiver_id']))->toOthers();


    //     // 2. save message in database
    //     $this->messageRepository->save($data);

    //     return 1;
    // }
}