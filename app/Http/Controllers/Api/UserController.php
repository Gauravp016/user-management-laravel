<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * GET /api/users
     */
    public function index()
    {
        return response()->json(
            $this->userService->getAllUsers(),
            200
        );
    }

    /**
     * POST /api/users
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json($user, 201);
    }

    /**
     * PUT /api/users/{user}
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->updateUser($user, $request->validated());

        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
