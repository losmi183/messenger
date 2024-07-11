<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Services\MessageServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MessageSendRequest;

class MessageController extends Controller
{
    public function send(MessageSendRequest $request, MessageServices $messageServices): JsonResponse
    {       
        // event(new MessageSent('new message', 5));
        // return response()->json(['status' => 'Message Sent!']);   

        $data = $request->validated();
        $messageServices->send($data);
        return response()->json(['status' => 'success']);
    }
}
