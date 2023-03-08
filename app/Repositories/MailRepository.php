<?php

namespace App\Repositories;

use App\Models\Mail;
use App\Models\User;

class MailRepository implements IMailRepository
{
    public function create(array $mail): Mail
    {
        $data = new Mail();
        $data->mail = $mail['mail'];
        $data->content = $mail['content'];
        $data->user_id = $mail['user_id'];
        $data->save();
        return $data;
    }

    public function all()
    {
        return Mail::all();
    }
}