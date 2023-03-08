<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\ITagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(ITagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTag()
    {
        $tag = $this->tagRepository->all();
        return response()->json([
            'data' => $tag
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $tag = $this->tagRepository->create($data);
        if (empty($tag)) {
            return response()->json([
                'status' => false,
                'message' => 'Thêm mới không thành công'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Thêm mới thành công'
        ]);
    }

    public function update(Request $request, $id)
    {
        $tag = $this->tagRepository->find($id);
        if (empty($tag)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        $tag = $request->all();
        $data = $this->tagRepository->update($id, $tag);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function delete($id)
    {
        $data = $this->tagRepository->find($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Xoá không thành công'
            ]);
        }
        $tag = $this->tagRepository->deleteTag($id);
//        dd($tag);
        $data = $this->tagRepository->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Xoá thành công'
        ]);
    }
}
