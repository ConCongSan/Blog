<?php

namespace App\Repositories\Backend;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostRepository extends BaseRepository implements IUserRepository
{
    public function getModel(): string
    {
        return Post::class;
    }
}