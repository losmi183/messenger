<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ConnectRequest;
use App\Http\Requests\UserSearchRequest;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    #[OA\Post(
        path: '/user/search',
        summary: 'Search user by name or email',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['search'],
        properties: [
            new OA\Property(property: 'search', type: 'string', default: 'user', description: 'search string'),
            ]
        ),
    )),
        tags: ['User'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'User registered'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function search(UserSearchRequest $request, UserServices $userServices): JsonResponse
    {
        $data = $request->validated();
        $users = $userServices->search($data);
        return response()->json($users);
    }

    #[OA\Get(
        path: '/user/show/{id}',
        summary: 'Find user by ID',
        tags: ['User'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'User ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'User found'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function show(UserServices $userServices, $id): JsonResponse
    {
        $users = $userServices->show($id);
        return response()->json($users);
    }   
}
