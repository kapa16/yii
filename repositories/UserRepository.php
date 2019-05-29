<?php

namespace app\repositories;

use app\entities\Users;

class UserRepository
{
    public function get($id): Users
    {
        if (!$user = Users::findOne($id)) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }
}