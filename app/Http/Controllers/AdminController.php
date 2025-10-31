<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AdminUsersRequest;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    private AdminServices $adminServices;

    public function __construct(AdminServices $adminServices) {
        $this->adminServices = $adminServices;
    }

    #[OA\Post(
        path: '/admin/users',
        summary: 'All users on database wwith filters and pagination',
        requestBody: new OA\RequestBody(required: true,
        content: new OA\MediaType(mediaType: 'application/json',
        schema: new OA\Schema(required: [''],
            properties: [
                new OA\Property(property: 'name', type: 'string', default: 'mil'),
                new OA\Property(property: 'email', type: 'string', default: 'mil'),
                new OA\Property(property: 'role', type: 'string', default: 'user'),
                new OA\Property(property: 'status', type: 'string', default: 'active'),
            ]
        ),
    )),
        tags: ['Admin'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: 'Connection Initiated'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error')
        ]
    )]
    public function users(AdminUsersRequest $request): JsonResponse
    {
        $params = $request->validated();

        $result = $this->adminServices->users($params);

        return response()->json($result);
    }
}
