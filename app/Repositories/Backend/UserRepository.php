<?php

namespace App\Repositories\Backend;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function getModel(): string
    {
        return User::class;
    }
}