<?php

namespace app\repositories;

use app\entities\User;

class UserRepository
{
    public function get($id): User
    {
        if (!$user = User::findOne($id)) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }
}