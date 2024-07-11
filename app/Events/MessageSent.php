<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_id;

    public function __construct(string $message, int $receiver_id)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
    }

    public function broadcastOn()
    {
        // return new Channel('my-channel');
        return new PrivateChannel('private-channel-' . $this->receiver_id);
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }
}