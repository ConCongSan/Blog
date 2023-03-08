<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;

class UserRepository implements IUserRepository
{

    public function all()
    {
        return User::all();
    }

    public function create(array $user)
    {
        $data = new User();
        $data->username = $user['username'];
        $data->name = $user['name'];
        $data->password = $user['password'];
        $data->phone = $user['phone'];
        $data->email = $user['email'];
//        $data->provider = $user['provider'];
//        $data->avatar = $user['avatar'];
        $data->save();
        return $data;
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($id, array $data)
    {
        $result = User::find($id)->update([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'avatar' => $data['avatar']
        ]);
        return $result;
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        return $post->post()->delete();
    }
}
