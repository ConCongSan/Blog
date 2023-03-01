<?php
namespace App\Repositories\Backend;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements ITagRepository
{
    public function getModel()
    {
        return Tag::class;
    }
}