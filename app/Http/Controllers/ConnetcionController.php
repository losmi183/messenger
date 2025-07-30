<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Services\ConnectionServices;
use App\Http\Requests\ConnectRequest;
use App\Http\Requests\InitiateAcceptRequest;
use App\Http\Requests\InitiateRejectRequest;
use App\Http\Requests\InitiateConnectionRequest;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ConnetcionController extends Controller
{
    private ConnectionServices $connectionServices;
    public function __construct(ConnectionServices $connectionServices) {
        $this->connectionServices = $connectionServices;
    }

    #[OA\Post(
        path: '/connection/initiate',
        summary: 'Initiate new connection',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['recipient_id'],
            properties: [
                new OA\Property(property: 'recipient_id', type: 'integer', default: 3),
            ]
        ),
    )),
        tags: ['Connection'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Connection Initiated'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function initiate(InitiateConnectionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->connectionServices->initiate($data['recipient_id']);
        return response()->json($result);
    }

    #[OA\Post(
        path: '/connection/accept',
        summary: 'Accept Connection',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['connection_id'],
            properties: [
                new OA\Property(property: 'connection_id', type: 'integer', default: 1),
            ]
        ),
    )),
        tags: ['Connection'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Connection accepted'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function accept(InitiateAcceptRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->connectionServices->accept($data['connection_id']);
        return response()->json($result);
    }

    #[OA\Post(
        path: '/connection/reject',
        summary: 'Reject Connection',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['connection_id'],
            properties: [
                new OA\Property(property: 'connection_id', type: 'integer', default: 1),
            ]
        ),
    )),
        tags: ['Connection'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Connection rejected'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function reject(InitiateRejectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->connectionServices->reject($data['connection_id']);
        return response()->json($result);
    }
}
