<?php

namespace App\Controllers;

use App\Models\UserEntity;
use App\Repositories\UserRepository;

class UserController
{
    public function showUsers()
    {
        $userRepository = new UserRepository();
        return $userRepository->show();
    }

    public function createUser(UserEntity $user)
    {
        $userRepository = new UserRepository();
        return $userRepository->create($user);
    }

    public function deleteUser(UserEntity $user)
    {
        $userRepository = new UserRepository();
        return $userRepository->delete($user);
    }

    public function getOneUser($userId)
    {
        $userRepository = new UserRepository();
        return $userRepository->getOne($userId);
    }

    public function loginUser($userId)
    {
        $userRepository = new UserRepository();
        return $userRepository->login($userId);
    }

    public function updateLogin(UserEntity $user)
    {
        $userRepository = new UserRepository();
        return $userRepository->updateLogin($user);
    }

    public function updateImage(UserEntity $user)
    {
        $userRepository = new UserRepository();
        return $userRepository->updateImage($user);
    }

    public function getUserNumber()
    {
        $userRepository = new UserRepository();
        return $userRepository->getUserNumber();
    }

    public function isUniqueUsernameAndPerson($username, $person)
    {
        $userRepository = new UserRepository();
        return $userRepository->isUniqueUsernameAndPerson($username, $person);
    }
}