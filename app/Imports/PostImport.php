<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
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
        $post = new Post([
            "title" => $row[0],
            "content" => $row[1],
//            "password" => Hash::make('password')
//            $data->name = $row['name'],
//            $data->password = $row['password'],
//            $data->phone = $row['phone'],
//            $data->email = $row['email'],
//            $data->provider = $row['provider'],
//            $data->avatar = $row['avatar'],
        ]);
        return $post;
    }
}
