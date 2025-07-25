<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    #[OA\Post(
        path: '/auth/register',
        summary: 'Register new user',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['email', 'password'],
            properties: [
                new OA\Property(property: 'name', type: 'string', default: 'newuser', description: 'user name'),
                new OA\Property(property: 'email', type: 'string', default: 'newuser@mail.com', description: 'email'),
                new OA\Property(property: 'password', type: 'string', default: 'Secret123#', description: 'password'),
            ]
        ),
    )),
        tags: ['Auth'],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'User registered'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function register(RegisterRequest $request, AuthServices $authServices): JsonResponse
    {
        $data = $request->validated();

        $result = $authServices->register($data);

        return response()->json($result);
    }

    #[OA\Post(
        path: '/auth/login',
        summary: 'Login user',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: ['email', 'password'],
            properties: [
                new OA\Property(property: 'email', type: 'string', default: 'user@mail.com', description: 'email'),
                new OA\Property(property: 'password', type: 'string', default: 'Secret123#', description: 'password'),
            ]
        ),
    )),
        tags: ['Auth'],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Korisnik prijavljen'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function login(LoginRequest $request, AuthServices $authServices): JsonResponse
    {
        $data = $request->validated();

        $result = $authServices->login($data);

        return response()->json([
            'token' => $result
        ]);
    }

    #[OA\Post(
        path: "/auth/whoami",
        summary: "Podaci o korisniku na osnovu tokena",
        tags: ["Auth"],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Podaci o korisniku vraćeni na front"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    public function whoami(Request $request, AuthServices $authServices): JsonResponse
    {
        $result = $authServices->whoami();
        return response()->json($result);
    }
    
    #[OA\Post(
        path: '/auth/logout',
        summary: 'Logout user',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
    )),
        tags: ['Auth'],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'User logged out'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function logout(): JsonResponse
    {
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
}
