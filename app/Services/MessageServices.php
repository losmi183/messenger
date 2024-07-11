<?php

namespace App\Services;
use App\Models\User;
use App\Events\MessageSent;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Repository\MessageRepository;

class MessageServices {

    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository) {
        $this->messageRepository = $messageRepository;
    }

    public function send(array $data): int
    {
        // 1. sand message to reciver via web socket to client 
        event(new MessageSent($data['message'], $data['receiver_id']));
        // broadcast(new MessageSent($data['message'], $data['receiver_id']))->toOthers();


        // 2. save message in database
        $this->messageRepository->save($data);

        return 1;
    }
}