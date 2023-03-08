<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository implements ITagRepository
{

    public function all()
    {
        return Tag::all();
    }

    public function create(array $tag)
    {
        $data = new Tag();
        $data->name = $tag['name'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return Tag::find($id);
    }

    public function update($id, array $data)
    {
        $result = Tag::find($id)->update([
            'name' => $data['name']
        ]);
        return $result;
    }

    public function delete($id)
    {
        return Tag::find($id)->delete();
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);
        return $tag->tag()->delete();
    }
}