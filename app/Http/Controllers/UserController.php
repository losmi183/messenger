<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\ConnectRequest;

class UserController extends Controller
{
    public function users(UsersRequest $request, UserServices $userServices): JsonResponse
    {
        $data = $request->validated();
        $users = $userServices->users($data);
        return response()->json($users);
    }
    public function user(UserRequest $request, UserServices $userServices): JsonResponse
    {
        $data = $request->validated();
        $users = $userServices->user($data['id']);
        return response()->json($users);
    }
    public function connect(ConnectRequest $request, UserServices $userServices): JsonResponse
    {
        $data = $request->validated();
        $users = $userServices->connect($data['id']);
        return response()->json($users);
    }
}
