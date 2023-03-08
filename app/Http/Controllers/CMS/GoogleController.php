<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        //dd($getInfo->email);
        $isExist = User::where('email', '=', $getInfo->email)->count();
        //dd($isExist);
        if ($isExist == 0) {
            $user = $this->createUser($getInfo, $provider);
            Auth::login($user);
            return redirect()->route('index');
        }
        $finduser = User::where('email', $getInfo->email)->first();
        Auth::login($finduser);
        return redirect()->route('index');
    }

    //Tạo người dùng
    function createUser($getInfo, $provider)
    {

//        $user = User::where('email', $getInfo->email)->first();
//        if (!$user) {
        $user = User::create([
            'username' => $getInfo->name,
            'email' => $getInfo->email,
            'provider' => $provider,
        ]);
        return $user;
    }
}
