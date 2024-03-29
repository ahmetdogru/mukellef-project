<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function saveUser(array $userData)
    {
        $user = new User();

        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        if(isset($userData['payment_provider']) && $userData['payment_provider'] != "")
            $user->payment_provider = $userData['payment_provider'];

        $user->save();

        return $user;
    }

    public function getUsers()
    {
        $users = User::all();

        return $users;
    }
}
