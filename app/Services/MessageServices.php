<?php

namespace App\Services;
use stdClass;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\Conversation;
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

    public function myConversations() {

        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];

        // $conversations = DB::table('conversation_user as cu')
        // ->select('c.id as conversation_id', 'type', 'title')
        // ->leftJoin('conversations as c', 'cu.conversation_id','=','c.id')
        // ->where('user_id', $user_id)
        // ->get();

        // $conversation_ids = $conversations->pluck('conversation_id')->toArray();

        // $conversation_user = DB::table('conversation_user as cu')
        // ->select('cu.conversation_id', DB::raw("GROUP_CONCAT(u.id) as user_ids, GROUP_CONCAT(u.name) as usernames"))
        // ->join('users as u', 'u.id', 'cu.user_id')
        // ->whereIn('cu.conversation_id', $conversation_ids)
        // ->where('cu.user_id', '!=', $user_id)
        // ->groupBy('cu.conversation_id')
        // ->get();

        // foreach($conversations as $conv) {

        //     $conv_users = $conversation_user->where('conversation_id', $conv->id)->first();
        //     // foreach($conv_users as $conv_user) {
        //     //     $user = explode(',', )

        //     // }

        //     $conv->users = $conversation_user
        //         ->where('conversation_id', $conv->id)
        //         ->first();
        // }

        $conversations = Conversation::whereHas('users', function($q) use ($user_id) {
            $q->where('users.id', $user_id);
        })
        ->with(['users' => function($q) use ($user_id) {
            $q->where('users.id', '!=', $user_id)
            ->select('users.id', 'users.name', 'conversation_user.last_read_message_id');
        }])
        ->get(['id', 'type', 'title']);

        return $conversations;
    }

    public function conversation(array $data)
    {
        $user = $this->jwtServices->getContent();
        $user_id = $user['id'];
        $conversation_id = intval($data['conversationId']);
        $last_message_id = $data['lastMessageId'] ? intval($data['lastMessageId']) : null;

        $conversation = Conversation::with(['users' => function($q) use ($user_id) {
            
            $q->where('users.id', '!=', $user_id)
            ->select('users.id', 'users.name', 'avatar', 'conversation_user.last_read_message_id');
        }])
        ->first();

        $conversation->messages = DB::table('messages as m')
        ->join('users as u', 'u.id', 'm.sender_id')
        ->select('m.*', 'u.name as sender_name')
        ->where('m.conversation_id', $conversation_id)
        ->orderBy('m.id','desc')
        ->get();
        
        return $conversation;
    }

    public function send(int $conversation_id, string $content): Message
    {
        $user = $this->jwtServices->getContent();
        unset($user['exp']);
        $event = 'message.sent';

        $this->pusherServices->push($event, $conversation_id, $content, $user);

        try {
            $message = Message::create([
                'sender_id' => $user['id'],
                'conversation_id' => $conversation_id,
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