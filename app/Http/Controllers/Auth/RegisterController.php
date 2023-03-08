<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['isAdmin'] = 1;
        $user = $this->userRepository->create($data);
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Đăng kí thất bại'
            ]);
        }
        return redirect()->route('getAllUser');
    }
}
