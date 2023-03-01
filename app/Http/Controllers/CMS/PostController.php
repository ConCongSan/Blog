<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\Backend\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
//    use image_Upload;
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function getAllPost()
    {
        $data = $this->post->index();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
//        $data['user_id'] = Auth::user()->id();
        $data['image'] = $this->uploadImage($request);
        $post = $this->post->store($data);
//        dd($post);
        if (!empty($post)) {
            return response()->json([
                'status' => true,
                'data' => $post,
                'message' => 'Tạo bài viết thành công'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Tạo bài viết không thành công'
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $this->post->show($id);
        if (empty($data->id)) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể cập nhật'
            ]);
        }
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);
        $post = $this->post->update($id, $data);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function show($id)
    {
        $post = $this->post->show($id);
        if (empty($post)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }

    public function delete($id)
    {
        $post = $this->post->show($id);
        if (empty($post)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        $this->post->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Xoá thành công'
        ]);
    }

    function uploadImage($request)
    {
        $data['image'] = $request->image;
        $nameImage = Str::random(6);
        if ($request->has("image") != null) {
            $fileName = "{$nameImage}.jpg";
            $request->file('image')->storeAs('anh', $fileName, 'public');
            $data['image'] = "$fileName";
            return $data['image'];
        }
    }
}