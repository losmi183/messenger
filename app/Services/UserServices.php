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

   
    public function search(array $data): ?Collection
    {
        return $this->userRepository->search($data);
    }

    public function show(int $id): ?User
    {
        return $this->userRepository->show($id);
    }
 }