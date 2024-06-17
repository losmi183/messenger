<?php

namespace App\Services;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserServices {

    private UserRepository $userRepository;
    private JWTServices $jwtServices;

    public function __construct(UserRepository $userRepository, JWTServices $jwtServices) {
        $this->userRepository = $userRepository;
        $this->jwtServices = $jwtServices;
    }

   
    public function users(array $data): ?Collection
    {
        return $this->userRepository->users($data);
    }

    public function user(int $id): ?User
    {
        return $this->userRepository->user($id);
    }

    public function connect(int $id): string
    {
        // token contain user data
        $user = $this->jwtServices->getContent();
        // Check if user is already have connection
        $connection = $this->userRepository->getConnection($user['id'], $id);

        // 1 connection not exsists
        if (!$connection) {
            $this->userRepository->makeConnection($user['id'], $id);
            return 'Connection requested';
        }

        // 2 connection already exsists and accepted
        if ($connection && $connection->accepted == 1) {
            abort(403, 'Connection already exsists and accepted');
        }
        
        // 3 connection already exsists but not accepted - user2_id need to accept connection
        if ($connection && $connection->accepted == 0 && $connection->user2_id == $user['id']) {
            $connection->accepted = 1;
            $connection->save();
            return 'Connection accepted';
        }

        abort(400, 'Connection not created!');
    }  
}