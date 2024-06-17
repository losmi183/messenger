<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthServices $authServices): JsonResponse
    {
        $data = $request->validated();

        $result = $authServices->register($data);

        return response()->json($result);
    }

    /**
     * @param LoginRequest $request
     * @param AuthServices $authServices
     * 
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthServices $authServices): JsonResponse
    {
        $data = $request->validated();

        $result = $authServices->login($data);

        return response()->json([
            'token' => $result
        ]);
    }

    public function whoami(Request $request, AuthServices $authServices): JsonResponse
    {
        $result = $authServices->whoami();
        return response()->json($result);
    }
    
    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
}
