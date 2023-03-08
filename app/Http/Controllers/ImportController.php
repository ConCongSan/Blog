<?php

namespace App\Http\Controllers;

use App\Imports\PostImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function uploadFileUser(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        return redirect()->route('Dashboard');
    }

    public function uploadFilePost(Request $request)
    {
        Excel::import(new PostImport(), $request->file('file'));
        return redirect()->route('Dashboard');
    }
}
