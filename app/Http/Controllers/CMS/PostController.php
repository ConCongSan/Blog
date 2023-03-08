<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\IPostRepository;
use App\Repositories\ITagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
//    use image_Upload;
    protected $postRepository;
    protected $tagRepository;

    public function __construct(IPostRepository $postRepository, ITagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    public function getAllPost()
    {
        $data = $this->postRepository->all();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);
        $post = $this->postRepository->create($data);
//        if (!empty($post)) {
//            return response()->json([
//                'status' => true,
//                'data' => $post,
//                'message' => 'Tạo bài viết thành công'
//            ]);
//        }

        Log::channel('customLog')->error('Fail :',['data' => $post]);
        return response()->json([
            'status' => false,
            'message' => 'Tạo bài viết không thành công'
        ]);
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->all();
        $data = $this->postRepository->find($id);
        return view('editpost')->with('tag', $tag)->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $data = $this->postRepository->find($id);
        if (empty($data->id)) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể cập nhật'
            ]);
        }
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);
        $post = $this->postRepository->update($id, $data);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
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
        $post = $this->postRepository->find($id);
        if (empty($post)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        $this->postRepository->delete($id);
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