<?php

namespace App\Imports;

use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

//    public function __construct(IUserRepository $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }

    public function model(array $row)
    {
        $user = new User([
            "username" => $row[0],
            "name" => $row[1],
            "phone" => $row[2],
//            "password" => Hash::make('password')
//            $data->name = $row['name'],
//            $data->password = $row['password'],
//            $data->phone = $row['phone'],
//            $data->email = $row['email'],
//            $data->provider = $row['provider'],
//            $data->avatar = $row['avatar'],
        ]);
        return $user;
    }
}
