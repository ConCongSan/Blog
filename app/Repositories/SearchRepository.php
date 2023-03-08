<?php
namespace App\Repositories;

use App\Models\Post;

class SearchRepository implements ISearchRepository
{

    public function searchTag($data)
    {
        return Post::where('tag_id', '=', $data)->get();
    }
}