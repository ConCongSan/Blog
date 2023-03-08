<?php

namespace App\Repositories;

interface IMailRepository
{
    public function create(array $data);
    public function all();
}