<?php

namespace App\Services;

use App\BO\UserBO;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserService
{
    protected $userBO;

    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
    }

    public function getAllUsers()
    {
        return Cache::remember('users_cache', 600, function () {
            return $this->userBO->getUsers();
        });
    }

    public function createUser(array $data)
    {
        Cache::forget('users_cache');
        return $this->userBO->createUser($data);
    }

    public function updateUser($user, array $data)
    {
        Cache::forget('users_cache');
        return $this->userBO->updateUser($user, $data);
    }

    public function deleteUser(User $user)
    {
        Cache::forget('users_cache');

        return $this->userBO->deleteUser($user);
    }
}
