<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function handle(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (!Auth::attempt($data)) {
            return 'Dang nhap that bai';
        }

        $sendEmail = 'kensu8434@gmail.com';
        $testmail = 'thinh';
        Mail::send('email', compact('testmail'), function ($email) {
            $email->subject('Tìm đồ thất lạc');
            $email->to('kensu8434@gmail.com');
            Log::channel('LogMail')->info('Success :', ['data' => $email]);
        });


//        return response()->json([
//            'status' => false,
//            'message' => 'Tạo bài viết không thành công'
//        ]);
        return redirect()->route('getAllUser');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
