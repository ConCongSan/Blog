<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('index');
    }
}
