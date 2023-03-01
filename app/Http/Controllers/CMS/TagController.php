<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function getAllTag()
    {
        $tag = $this->tag->index();
        return response()->json([
            'data' => $tag
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $tag = $this->tag->store($data);
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
        $tag = $this->tag->show($id);
        if (empty($tag)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        $tag = $request->all();
        $data = $this->tag->update($id, $tag);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function delete($id)
    {
        $data = $this->tag->show($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Thêm mới không thành công'
            ]);
        }
        $data = $this->tag->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Thêm mới thành công'
        ]);
    }
}
