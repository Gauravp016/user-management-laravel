<?php

namespace App\DAO;

use App\Models\User;

class UserDAO
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
}
