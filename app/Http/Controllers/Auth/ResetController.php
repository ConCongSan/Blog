<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('password');
    }

    public function reset(Request $request)
    {
        $user = $this->userRepository->find(Auth::user()->id);
        if ($request->password_old != null && $request->password == $request->password_confirmation) {
            //Kiểm tra Mật khẩu cũ có giống với mật khẩu đã đăng ký
            if (Hash::check($request->password_old, $user->password)) {
//                DB::beginTransaction();
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json([
                    'status' => true,
                    'messsage' => 'Cập nhật mật khẩu thành công'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'messsage' => 'Cập nhật mật khẩu không thành công'
        ]);
    }
}
