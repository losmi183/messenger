<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminServices {

    public function users(array $params)
    {
        $itemsPerPage = $params['itemsPerPage'] ?? 10;
        $page = $params['page'] ?? 1;
        $name = $params['name'] ?? null;
        $email = $params['email'] ?? null; 
        $role = $params['role'] ?? null;
        $status = $params['status'] ?? null;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $users = DB::table('users')
            ->when($name, function ($q) use ($name) {
                return $q->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($name, function ($q) use ($email) {
                return $q->where('name', 'LIKE', '%' . $email . '%');
            })
            ->when($name, function ($q) use ($role) {
                return $q->where('name', $role);
            })
            ->when($name, function ($q) use ($status) {
                return $q->where('name', $status);
            })
             ->paginate( $itemsPerPage);

        return $users;
    }


 }