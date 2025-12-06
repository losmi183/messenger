<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Events\MessageSent;
use App\Services\JWTServices;
use OpenApi\Attributes as OA;
use App\Services\MessageServices;
use Illuminate\Http\JsonResponse;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MarkAsSeenRequest;
use App\Http\Requests\MessageSeenRequest;
use App\Http\Requests\MessageSendRequest;
use App\Http\Requests\ConversationRequest;
use Symfony\Component\HttpFoundation\Response;


class MessageController extends Controller
{
    private MessageServices $messageServices;
    private JWTServices $jWTServices;
    public function __construct(UserRepository $userRepository, MessageServices $messageServices, JWTServices $jWTServices) {
        $this->userRepository = $userRepository;
        $this->messageServices = $messageServices;
        $this->jWTServices = $jWTServices;
    }

    #[OA\Get(
        path: '/message/my-conversations',
        summary: 'Get all conversations for authenticated user',
        tags: ['Message'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'All user conversations'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function myConversations(): JsonResponse {
             
        $result = $this->messageServices->myConversations();
        return response()->json($result);

    }


    #[OA\Get(
        path: '/message/conversation/{friend_id}',
        summary: 'Get conversation with a friend',
        tags: ['Message'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'friend_id',
                in: 'path',
                required: true,
                description: 'ID of the friend to fetch conversation with',
                schema: new OA\Schema(type: 'integer', example: 3)
            )
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Conversation retrieved successfully'),
            new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function conversation(ConversationRequest $request): JsonResponse
    {
        $data = $request->validated();        

        $result = $this->messageServices->conversation($data);

        return response()->json($result);
    }


    #[OA\Post(
        path: '/message/send',
        summary: 'Send message',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['recipient_id'],
            properties: [
                new OA\Property(property: 'recipient_id', type: 'integer', default: 3),
                new OA\Property(property: 'content', type: 'text', default: 'lorem ipsum'),
            ]
        ),
    )),
        tags: ['Message'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Message sent'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function send(MessageSendRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->messageServices->send($data['conversationId'], $data['content']);        

        return response()->json(['status' => 'success']);
    }

    public function seen(MessageSeenRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->messageServices->seen($data['friend_id'], $data['seen']);        

        return response()->json($result);
    }

    public function markAsSeen(MarkAsSeenRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->messageServices->markAsSeen($data['friend_id']);        

        return response()->json($result);
    }
}
