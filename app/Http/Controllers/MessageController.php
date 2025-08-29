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
use App\Http\Requests\MessageSendRequest;
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
    public function conversation(int $friend_id): JsonResponse
    {
        $result = $this->messageServices->conversation($friend_id);

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

        $this->messageServices->send($data['recipient_id'], $data['content']);        

        return response()->json(['status' => 'success']);
    }
}
