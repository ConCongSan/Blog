<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostRepository implements IPostRepository
{
//    protected $data;

    public function all()
    {
        return $data = Post::orderBy('id','DESC')->paginate(3);
    }

    public function create(array $post)
    {
        $data = new Post();
        $data->title = $post['title'];
        $data->content = $post['content'];
        $data->image = $post['image'];
        $data->tag_id = $post['tag_id'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function update($id, array $data)
    {
        $result = Post::find($id)->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'],
            'tag_id' => $data['tag_id']
        ]);
        return $result;
    }

    public function delete($id)
    {
        return Post::find($id)->delete();
    }

    public function deletePost($id)
    {
        // TODO: Implement deletePost() method.
    }

//    function uploadImage($request)
//    {
//        $data['image'] = $request->image;
//        $nameImage = Str::random(6);
//        if ($request->has("image") != null) {
//            $fileName = "{$nameImage}.jpg";
//            $request->file('image')->storeAs('anh', $fileName, 'public');
//            $data['image'] = "$fileName";
//            return $data['image'];
//        }
//    }
}