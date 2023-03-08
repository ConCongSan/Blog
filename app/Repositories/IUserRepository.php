<?php
namespace App\Repositories;

interface IUserReponsitory
{
    public function all();
    public function create();
    public function find();
    public function update();
    public function delete();
}