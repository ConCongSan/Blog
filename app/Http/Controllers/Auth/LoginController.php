<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (!Auth::attempt($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Đăng nhập thất bại'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công'
        ]);
    }
}
