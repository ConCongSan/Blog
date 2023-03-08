<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Backend\UserRepository;
use App\Repositories\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//use imageUpload;

/**
 * @property User $user
 */
class UserController extends Controller
{
//    use imageUpload;
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        $data = $this->userRepository->all();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $data['avatar'] = $this->uploadImage($request);
        $user = $this->userRepository->update($id, $data);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật tài khoản thành công'
        ]);
    }

    public function updatePass($token, Request $request)
    {
//        $user = User::find(Auth::user()->id);
//        if ($request->password_old != null && $request->password == $request->password_confirmation) {
//            //Kiểm tra Mật khẩu cũ có giống với mật khẩu đã đăng ký
//            if (Hash::check($request->password_old, $user->password)) {
////                DB::beginTransaction();
//                $user->password = Hash::make($request->password);
//                $user->save();
//                return response()->json([
//                    'status' => true,
//                    'messsage' => 'Cập nhật mật khẩu thành công'
//                ]);
//            }
//        }


        return response()->json([
            'status' => false,
            'messsage' => 'Cập nhật mật khẩu không thành công'
        ]);
    }

    public function forgotPass(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Str::random(6);
        $user->token = $token;
        $user->save();
        if ($this->checkToken($user, $token)) {
//            $data[]
        }
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    function uploadImage($request)
    {
        $data['avatar'] = $request->image;
        $nameImage = Str::random(6);
        if ($request->has("image") != null) {
            $fileName = "{$nameImage}.jpg";
            $request->file('image')->storeAs('anh', $fileName, 'public');
            $data['avatar'] = "$fileName";
            return $data['avatar'];
        }
    }

    public function delete($id)
    {
        $user = $this->userRepository->delete($id);
        $post = $this->userRepository->deletePost($id);
        return response()->json([
            'status' => true,
            'message' => 'Đã xoá thành công',
        ]);

    }

    function checkToken(User $user, $token)
    {
        if ($user->token == $token) {
            return true;
        }
        return false;
    }
}