<?php

namespace App\Repositories\Backend;

use App\Repositories\IBaseRepository;
interface IUserRepository extends IBaseRepository
{
    public function index();
    public function store(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}