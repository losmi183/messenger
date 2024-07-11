<?php

namespace App\Services;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthServices {

    private UserRepository $userRepository;
    private JWTServices $jwtServices;

    public function __construct(UserRepository $userRepository, JWTServices $jwtServices) {
        $this->userRepository = $userRepository;
        $this->jwtServices = $jwtServices;
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->store($data);
    }

    /**
     * @param array $data
     * 
     * @return string
     */
    public function login(array $data): string
    {
        $user = $this->userRepository->findByEmail($data['email']);
        // If user found, check password is correct
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $this->jwtServices->createJWT($user, 60000);
            return $token;
        }

        abort(400, 'Invalid credentials');
    }

    public function whoami(): ?array
    {
        return $this->jwtServices->getContent();
    }
}