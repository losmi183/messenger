<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @param array $data
     * 
     * @return User
     */
    public function store(array $data): User
    {
        try {
            $user = User::create($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            abort(400, 'User not registered');
        }
        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function search(array $data): ?Collection
    {
        $search = $data['search'] ?? null;
        return User::when($search, function ($query) use ($search) {
            return $query->where('email', 'LIKE', '%'.$search.'%')
                ->orWhere('name', 'LIKE', '%'.$search.'%');
        }) 
        ->get();
    }

    public function show(int $id): ?User
    {
        return User::find($id);
    }
}