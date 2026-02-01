<?php

namespace App\BO;

use App\DAO\UserDAO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserBO
{
    protected $userDAO;

    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function getUsers()
    {
        return $this->userDAO->getAllUsers();
    }

    public function createUser(array $data)
    {
        // Business rule: encrypt password
        $data['password'] = Hash::make($data['password']);

        return $this->userDAO->createUser($data);
    }

    public function updateUser($user, array $data)
    {
        return $this->userDAO->updateUser($user, $data);
    }

    public function deleteUser(User $user)
    {
        return $this->userDAO->deleteUser($user);
    }
}
